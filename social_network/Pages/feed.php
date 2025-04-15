<?php
$users = json_decode(file_get_contents(__DIR__ . '/../json/users.json'), true);
$posts = json_decode(file_get_contents(__DIR__ . '/../json/posts.json'), true);

// функция поиска пользователя по id
function getUserById($users, $id)
{
    foreach ($users as $user) {
        if ($user['id'] == $id) return $user;
    }
    return null;
}
?>


<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лента</title>
    <link rel="stylesheet" href="/css/feed.css">
</head>

<body>
    <div class="page">

        <!-- Сайдбар -->
        <div class="sidebar">
            <ul class="icons-list">
                <li><a class="icon icon--home"></a></li>
                <li><a href="/pages/profile.php" class="icon icon--profile"></a></li>
                <li><a class="icon icon--add"></a></li>
            </ul>
        </div>

        <!-- Шапка -->
        <div class="header"></div>
        <!-- Лента -->
        <main class="feed">
            <?php foreach ($posts as $post): ?>
                <?php include(__DIR__ . '/../templates/post.php'); ?>
            <?php endforeach; ?>
        </main>

    </div>
</body>

</html>