<?php

require_once(__DIR__ . '/../source/databaseConnection.php');

// Только POST
$method = $_SERVER['REQUEST_METHOD'];
if ($method !== 'POST') {
    echo json_encode(['error' => 'Только POST разрешен']);
    exit;
}

// Проверка наличия файла и JSON-строки
if (!isset($_FILES['image']) || !isset($_POST['data'])) {
    echo json_encode(['error' => 'Ожидается JSON и файл']);
    exit;
}

// Декод JSON
$data = json_decode($_POST['data'], true);
if (!$data || !isset($data['descr']) || !isset($data['id_user'])) {
    echo json_encode(['error' => 'Неверный JSON']);
    exit;
}

// Обработка изображения
$image = $_FILES['image'];
if ($image['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['error' => 'Ошибка загрузки файла']);
    exit;
}

$filename = basename($image['name']);
$imagePath = __DIR__ . '/../images/' . $filename;


if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
    echo json_encode(['error' => 'Не удалось сохранить файл']);
    exit;
}

// Вставка в БД
try {
    $connection = connectDatabase();

    //carousel
    $stmtCarousel = $connection->prepare("INSERT INTO carousel (image_1) VALUES (:image)");
    $stmtCarousel->execute([':image' => '/images/' . $filename]);
    $carouselId = $connection->lastInsertId();

    //post
    $stmtPost = $connection->prepare("
        INSERT INTO post (id_user, descr, likes, publish_date, id_carousel)
        VALUES (:id_user, :descr, 0, NOW(), :id_carousel)
    ");
    $stmtPost->execute([
        ':id_user' => $data['id_user'],
        ':descr' => $data['descr'],
        ':id_carousel' => $carouselId
    ]);

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Ошибка БД: ' . $e->getMessage()]);
    exit;
}
