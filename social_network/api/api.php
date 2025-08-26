<?php
require_once(__DIR__ . '/../source/databaseConnection.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Только POST разрешен']);
    exit;
}

if (!isset($_FILES['images']) || !isset($_POST['data'])) {
    echo json_encode(['error' => 'Ожидается JSON и файлы']);
    exit;
}

$data = json_decode($_POST['data'], true);
if (!$data || !isset($data['descr']) || !isset($data['id_user'])) {
    echo json_encode(['error' => 'Неверный JSON']);
    exit;
}

$files = $_FILES['images'];
$uploadedImages = [];

try {
    $connection = connectDatabase();

    // Подготавливаем массив для колонок и параметров под пост
    $columns = ['id_user', 'descr', 'likes', 'publish_date'];
    $placeholders = [':id_user', ':descr', '0', 'NOW()'];
    $params = [
        ':id_user' => $data['id_user'],
        ':descr'   => $data['descr']
    ];

    // Загружаем файлы и добавляем их в запрос
    foreach ($files['tmp_name'] as $i => $tmpName) {
        if ($files['error'][$i] !== UPLOAD_ERR_OK) continue;

        $filename = basename($files['name'][$i]);
        $imagePath = __DIR__ . '/../images/' . $filename;

        if (!move_uploaded_file($tmpName, $imagePath)) continue;

        $uploadedImages[$i + 1] = '/images/' . $filename;
        $columns[] = "image_" . ($i + 1);
        $placeholders[] = ":image_" . ($i + 1);
        $params[":image_" . ($i + 1)] = '/images/' . $filename;
    }

    if (empty($uploadedImages)) {
        echo json_encode(['error' => 'Не удалось загрузить ни одно фото']);
        exit;
    }

    // Вставка поста с картинками прямо в post
    $stmtPost = $connection->prepare("
        INSERT INTO post (" . implode(',', $columns) . ")
        VALUES (" . implode(',', $placeholders) . ")
    ");
    $stmtPost->execute($params);

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Ошибка БД: ' . $e->getMessage()]);
    exit;
}
