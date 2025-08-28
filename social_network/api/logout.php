<?php
session_start();

// Удаляем все данные сессии
$_SESSION = [];

// Уничтожаем саму сессию
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

session_destroy();

header('Content-Type: application/json');
http_response_code(200);
echo json_encode(['success' => true, 'message' => 'Выход выполнен']);
