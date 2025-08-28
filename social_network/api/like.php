<?php
session_start();
require_once '../source/databaseConnection.php';

header('Content-Type: application/json');

// Убедимся, что есть подключение
try {
    $connection = connectDatabase();
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Ошибка подключения к БД: ' . $e->getMessage()]);
    exit;
}

if (!isset($_POST['post_id'], $_POST['action'])) {
    echo json_encode(['success' => false, 'error' => 'Некорректные данные']);
    exit;
}

$postId = (int) $_POST['post_id'];
$action = $_POST['action']; // add | remove

try {
    if ($action === 'add') {
        $stmt = $connection->prepare("UPDATE post SET likes = likes + 1 WHERE id = :id");
    } elseif ($action === 'remove') {
        $stmt = $connection->prepare("UPDATE post SET likes = GREATEST(likes - 1, 0) WHERE id = :id");
    } else {
        echo json_encode(['success' => false, 'error' => 'Неизвестное действие']);
        exit;
    }

    $stmt->execute([':id' => $postId]);

    // Получаем новое количество лайков
    $stmt = $connection->prepare("SELECT likes FROM post WHERE id = :id");
    $stmt->execute([':id' => $postId]);
    $likes = $stmt->fetchColumn();

    echo json_encode([
        'success' => true,
        'likes' => (int)$likes
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Ошибка БД: ' . $e->getMessage()
    ]);
}
