<?php

require_once(__DIR__ . '/../source/databaseConnection.php');

// Только POST
$method = $_SERVER['REQUEST_METHOD'];
if ($method !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Только POST разрешен']);
    exit;
}

// Проверка наличия файла и JSON-строки
if (!isset($_FILES['image']) || !isset($_POST['data'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Ожидается JSON и файл']);
    exit;
}

// Декодим JSON
$data = json_decode($_POST['data'], true);
if (!$data || !isset($data['descr']) || !isset($data['id_user'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Неверный JSON']);
    exit;
}

// Обработка изображения
$image = $_FILES['image'];
if ($image['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode(['error' => 'Ошибка загрузки файла']);
    exit;
}

$filename = uniqid('img_', true) . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
$imagePath = __DIR__ . '/../images/' . $filename;

if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
    http_response_code(500);
    echo json_encode(['error' => 'Не удалось сохранить файл']);
    exit;
}

// Сохраняем в БД
try {
    $connection = connectDatabase();

    // 1. Сохраняем в таблицу carousel
    $stmtCarousel = $connection->prepare("INSERT INTO carousel (image_1) VALUES (:image)");
    $stmtCarousel->execute([':image' => '/images/' . $filename]);
    $carouselId = $connection->lastInsertId();

    // 2. Сохраняем в таблицу post
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
    http_response_code(500);
    echo json_encode(['error' => 'Ошибка БД: ' . $e->getMessage()]);
    exit;
}
