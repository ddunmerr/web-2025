<?php
require_once __DIR__ . '/databaseConnection.php';

function authByCookie(): array
{
    session_start();

    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        echo json_encode(['success' => false, 'error' => 'Сессия не найдена']);
        exit;
    }

    $userId = (int)$_SESSION['user_id'];
    $connection = connectDatabase();

    $user = findUserInDatabase($connection, $userId);
    if (!$user) {
        http_response_code(401);
        echo json_encode(['success' => false, 'error' => 'Пользователь не найден']);
        exit;
    }

    // Возвращаем данные пользователя для дальнейшего использования
    return $user;
}
