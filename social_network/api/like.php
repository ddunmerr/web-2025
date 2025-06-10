<?php
require_once(__DIR__ . '/../source/databaseConnection.php');
$connection = connectDatabase();

session_start();
$userId = $_SESSION['user_id'] ?? null;
if (!$userId) {
    http_response_code(401);
    echo json_encode(['error' => 'Неавторизованный пользователь']);
    exit;
}

$postId = $_POST['post_id'] ?? null;
if (!$postId) {
    http_response_code(400);
    echo json_encode(['error' => 'Пост не указан']);
    exit;
}

// Проверяем, есть ли лайк от пользователя
$query = $connection->prepare("SELECT COUNT(*) FROM likes WHERE post_id = ? AND user_id = ?");
$query->execute([$postId, $userId]);
$hasLike = $query->fetchColumn() > 0;

try {
    if ($hasLike) {
        // Удаляем лайк
        $stmt = $connection->prepare("DELETE FROM likes WHERE post_id = ? AND user_id = ?");
        $stmt->execute([$postId, $userId]);
        // Уменьшаем счётчик лайков в таблице постов (если есть поле likes)
        $connection->prepare("UPDATE posts SET likes = likes - 1 WHERE id = ?")->execute([$postId]);
        $liked = false;
    } else {
        // Добавляем лайк
        $stmt = $connection->prepare("INSERT INTO likes (post_id, user_id) VALUES (?, ?)");
        $stmt->execute([$postId, $userId]);
        // Увеличиваем счётчик лайков
        $connection->prepare("UPDATE posts SET likes = likes + 1 WHERE id = ?")->execute([$postId]);
        $liked = true;
    }

    // Получаем актуальное количество лайков
    $count = $connection->prepare("SELECT likes FROM posts WHERE id = ?");
    $count->execute([$postId]);
    $likesCount = $count->fetchColumn();

    echo json_encode(['success' => true, 'liked' => $liked, 'likesCount' => $likesCount]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Ошибка сервера: ' . $e->getMessage()]);
}
