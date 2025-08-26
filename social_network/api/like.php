<?php
session_start();
header('Content-Type: application/json');

$pdo = connectDatabase();
$postId = $_POST['id'] ?? null;

if (!$postId) {
    echo json_encode(['success' => false, 'error' => 'No ID']);
    exit;
}

// Проверим, существует ли пост
$stmt = $pdo->prepare("SELECT likes FROM post WHERE id = ?");
$stmt->execute([$postId]);
$currentLikes = $stmt->fetchColumn();

if ($currentLikes === false) {
    echo json_encode(['success' => false, 'error' => 'Post not found']);
    exit;
}

if (!isset($_SESSION['liked_posts'])) {
    $_SESSION['liked_posts'] = [];
}

$isLiked = isset($_SESSION['liked_posts'][$postId]);

if ($isLiked) {
    $stmt = $pdo->prepare("UPDATE post SET likes = GREATEST(likes - 1, 0) WHERE id = ?");
    $stmt->execute([$postId]);
    unset($_SESSION['liked_posts'][$postId]);
    $liked = false;
} else {
    $stmt = $pdo->prepare("UPDATE post SET likes = likes + 1 WHERE id = ?");
    $stmt->execute([$postId]);
    $_SESSION['liked_posts'][$postId] = true;
    $liked = true;
}

$stmt = $pdo->prepare("SELECT likes FROM post WHERE id = ?");
$stmt->execute([$postId]);
$likes = $stmt->fetchColumn();

echo json_encode(['success' => true, 'likes' => $likes, 'liked' => $liked]);
