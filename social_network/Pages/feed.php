<?php
require_once(__DIR__ . '/../source/databaseConnection.php');

$connection = connectDatabase();
$posts = getAllPosts($connection);

?>


<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.4">
    <title>Лента</title>
    <link rel="stylesheet" href="/css/feed.css">
</head>

<body>
    <div class="page">
        <!-- Сайдбар -->
        <div class="sidebar">
            <ul class="sidebar__icons-list">
                <li><a class="sidebar__icon sidebar__icon--home"></a></li>
                <li><a href="/pages/profile.php" class="sidebar__icon sidebar__icon--profile"></a></li>
                <li><a href="/pages/addPost.php" class="sidebar__icon sidebar__icon--add"></a></li>
            </ul>
        </div>

        <!-- Шапка -->
        <div class="header"></div>
        <!-- Лента -->
        <main class="feed">
            <?php
            foreach ($posts as $post)
                require(__DIR__ . '/../templates/post.php');
            ?>
        </main>

    </div>
</body>

</html>