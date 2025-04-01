<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лента</title>
    <link rel="stylesheet" href="/css/feed.css">
</head>

<body>
    <div class="container">

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
            <!-- Пост 1 -->
            <div class="post">
                <div class="post-header">
                    <div class="post-author">
                        <img class="user-avatar user-avatar-ivan2004"></img>
                        <span class="user-name">Ваня Денисов</span>
                    </div>
                    <button class="edit-button"></button>
                </div>
                <img class="post-image" src="/images/v412_61.png" alt="Пост пользователя">
                <span class="span-reaction">
                    <button class="like-button"> 204
                        <img class="like-img" src="/icons/like.svg">
                    </button>

                </span>
                <div class="post-content">
                    <p class="post-text">Так красиво сегодня на улице! Настоящая зима)) Вспоминается Бродский: «Поздно ночью, в уснувшей долине, на самом дне, в городке, занесенном снегом по ручку двери...»</p>
                    <span class="post-time">2 часа назад</span>
                </div>
            </div>

            <!-- Пост 2 -->
            <div class="post">
                <div class="post-header">
                    <div class="post-author">
                        <img class="user-avatar user-avatar-lizadem"></img>
                        <span class="user-name">Лиза Дёмина</span>
                    </div>
                    <button class="edit-button"></button>
                </div>
                <img class="post-image" src="/images/v412_77.png" alt="Пост пользователя">

                <button class="like-button">
                    204
                </button>


                <div class="post-content">
                    <span class="post-time">1 день назад</span>
                </div>
            </div>
        </main>

    </div>

</body>

</html>