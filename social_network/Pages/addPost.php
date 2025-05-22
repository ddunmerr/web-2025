<?php
require_once(__DIR__ . '/../source/databaseConnection.php');

$connection = connectDatabase();
$posts = getAllPosts($connection);

?>


<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новый пост</title>
    <link rel="stylesheet" href="/css/addPost.css">
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
        <form class="feed">
            <div class="photo-frame">
                <p class="picture-emoji">🖼</p>
                <button class="add-button-first">Добавить фото</button>
            </div>
            <button class="add-button-second">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.6667 2H3.33333C2.59695 2 2 2.59695 2 3.33333V12.6667C2 13.403 2.59695 14 3.33333 14H12.6667C13.403 14 14 13.403 14 12.6667V3.33333C14 2.59695 13.403 2 12.6667 2Z" stroke="#3F8AE0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M8 5.33398V10.6673" stroke="#3F8AE0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M5.33319 8H10.6665" stroke="#3F8AE0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Добавить фото
            </button>
            <textarea class="post-text" placeholder="Добавьте подпись..." maxlength="100"></textarea>
            <button class="send-button">Поделиться</button>

        </form>

    </div>
</body>

</html>