<?php
require_once(__DIR__ . '/../source/databaseConnection.php');

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Только POST разрешен']);
    exit;
}

if (!isset($_POST['data'])) {
    echo json_encode(['error' => 'Ожидается JSON в поле data']);
    exit;
}

$data = json_decode($_POST['data'], true);
if (!$data || !isset($data['descr'])) {
    echo json_encode(['error' => 'Неверный JSON']);
    exit;
}

$files = $_FILES['images'] ?? null;

try {
    $connection = connectDatabase();

    // --- UPDATE ---
    if (!empty($data['id'])) {
        $postId = (int)$data['id'];

        // Обновляем текст
        $updates = ["descr = :descr"];
        $params  = [':descr' => $data['descr'], ':id' => $postId];

        // Если пришли новые картинки — раскладываем по свободным слотам, а если их нет, перезаписываем с image_1
        if ($files && isset($files['tmp_name']) && is_array($files['tmp_name'])) {
            // Получим текущие колонки, чтобы понять свободные слоты
            $stmt = $connection->prepare("SELECT image_1, image_2, image_3, image_4, image_5 FROM post WHERE id = :id");
            $stmt->execute([':id' => $postId]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC) ?: [];

            $freeSlots = [];
            for ($i = 1; $i <= 5; $i++) {
                if (empty($row["image_$i"])) $freeSlots[] = $i;
            }

            $nextSlotIdx = 0; // индекс в массиве свободных слотов
            $overwriteFrom = 1; // если слотов нет — начнём перезапись с image_1

            foreach ($files['tmp_name'] as $i => $tmpName) {
                if ($files['error'][$i] !== UPLOAD_ERR_OK || !is_uploaded_file($tmpName)) continue;

                $ext = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
                $safeName = bin2hex(random_bytes(6)) . '_' . time() . ($ext ? "." . preg_replace('/[^a-zA-Z0-9]+/', '', $ext) : '');
                $imagePathFs = __DIR__ . '/../images/' . $safeName;
                if (!move_uploaded_file($tmpName, $imagePathFs)) continue;

                // решаем, какой слот занять
                if ($nextSlotIdx < count($freeSlots)) {
                    $slot = $freeSlots[$nextSlotIdx++];
                } else {
                    $slot = $overwriteFrom++;
                    if ($overwriteFrom > 5) $overwriteFrom = 1;
                }

                $col = "image_$slot";
                $updates[] = "$col = :$col";
                $params[":$col"] = '/images/' . $safeName;
            }
        }

        $sql = "UPDATE post SET " . implode(', ', $updates) . " WHERE id = :id";
        $stmt = $connection->prepare($sql);
        $stmt->execute($params);

        echo json_encode(['success' => true, 'mode' => 'update']);
        exit;
    }

    // --- INSERT ---
    if (!isset($data['id_user'])) {
        echo json_encode(['error' => 'id_user обязателен для создания']);
        exit;
    }

    $columns = ['id_user', 'descr', 'likes', 'publish_date'];
    $placeholders = [':id_user', ':descr', '0', 'NOW()'];
    $params = [':id_user' => (int)$data['id_user'], ':descr' => $data['descr']];

    if ($files && isset($files['tmp_name']) && is_array($files['tmp_name'])) {
        $slot = 1;
        foreach ($files['tmp_name'] as $i => $tmpName) {
            if ($files['error'][$i] !== UPLOAD_ERR_OK || !is_uploaded_file($tmpName)) continue;
            if ($slot > 5) break;

            $ext = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
            $safeName = bin2hex(random_bytes(6)) . '_' . time() . ($ext ? "." . preg_replace('/[^a-zA-Z0-9]+/', '', $ext) : '');
            $imagePathFs = __DIR__ . '/../images/' . $safeName;
            if (!move_uploaded_file($tmpName, $imagePathFs)) continue;

            $columns[] = "image_$slot";
            $placeholders[] = ":image_$slot";
            $params[":image_$slot"] = '/images/' . $safeName;
            $slot++;
        }
    }

    $sql = "INSERT INTO post (" . implode(',', $columns) . ") VALUES (" . implode(',', $placeholders) . ")";
    $stmt = $connection->prepare($sql);
    $stmt->execute($params);

    echo json_encode(['success' => true, 'mode' => 'insert']);
    exit;
} catch (Throwable $e) {
    echo json_encode(['error' => 'Серверная ошибка: ' . $e->getMessage()]);
    exit;
}
