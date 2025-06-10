<?php
session_start();
require_once '../source/databaseConnection.php';
$connection = connectDatabase();


header('Content-Type: application/json');

// Получаем JSON-данные из тела запроса
$data = json_decode(file_get_contents('php://input'), true);

$email = trim($data['email'] ?? '');
$password = $data['password'] ?? '';

// Проверка наличия данных
if (empty($email) || empty($password)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Email и пароль обязательны']);
    exit;
}

// Поиск пользователя по email
$stmt = $connection->prepare("SELECT * FROM user WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Пользователь не найден']);
    exit;
}

// Проверка пароля
if ($user['pass'] !== $password) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Неверный пароль']);
    exit;
}

// Установка сессии
$_SESSION['user_id'] = $user['id'];

http_response_code(200);
echo json_encode(['success' => true, 'message' => 'Успешный вход']);
