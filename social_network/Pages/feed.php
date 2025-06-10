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
    <title>Лента</title>
    <link rel="stylesheet" href="/css/feed.css">
    <script src="/js/carousel.js" defer></script>
    <script src="/js/modal.js" defer></script>


</head>

<body>
    <div class="page">
        <!-- Сайдбар -->
        <div class="sidebar">
            <ul class="sidebar__icons-list">
                <li><a class="sidebar__icon sidebar__icon--home" href="/"></a></li>
                <li><a href="/pages/profile.php" class="sidebar__icon sidebar__icon--profile"></a></li>
                <li><a href="/pages/addPost.php" class="sidebar__icon sidebar__icon--add"></a></li>
            </ul>
        </div>

        <!-- Шапка -->
        <div class="main-header"></div>

        <!-- Лента -->
        <main class="feed">
            <?php
            foreach ($posts as $post)
                require(__DIR__ . '/../templates/post.php');
            ?>
        </main>
    </div>

    <!-- Модальное окно -->
    <div class="modal-container" style="display:none;">
        <div class="content">
            <button class="content__close-button" aria-label="Закрыть модальное окно"></button>
            <div class="modal-carousel">
                <!-- Картинки rвставятся динамически -->
            </div>
            <div class="post__navigation">
                <button class="post__carousel-button post__carousel-button--prev"></button>
                <button class="post__carousel-button post__carousel-button--next"></button>
            </div>
            <p class="content__indicator"></p>
        </div>
    </div>



</body>

</html>