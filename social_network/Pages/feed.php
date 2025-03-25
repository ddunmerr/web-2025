<?php
if (!empty($_GET['q'])) {
    $query = htmlspecialchars($_GET['q'], ENT_QUOTES, 'UTF-8');

    switch ($query) {
        case 'info':
            phpinfo();
            exit;
        default:
            header("HTTP/1.0 404 Not Found");
            echo "Invalid query parameter.";
            exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лента</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <div class="container">
        <!-- Сайдбар -->
        <div class="sidebar">
            <div class="icons-list">
                <ul>
                    <li><a class="icon icon--home"></a></li>
                    <li><a href="/pages/profile.php" class="icon icon--profile"></a></li>
                    <li><a class="icon icon--add"></a></li>
                </ul>
            </div>
        </div>
        <!-- Шапка -->
        <div class="header"></div>

        <!-- Лента -->
        <main class="feed">
            <!-- Пост 1 -->
            <div class="post">
                <div class="post-header">
                    <div class="user">
                        <div class="user-avatar" id="ivan2004"></div>
                        <span class="user-name">Ваня Денисов</span>
                    </div>
                    <div class="edit-button"></div>
                </div>
                <img class="post-image" src="/images/v412_61.png" alt="Пост пользователя">
                <span class="span-reaction">
                    <button class="like-button">
                    </button>
                    204
                </span>
                <div class="post-content">
                    <p class="post-text">Так красиво сегодня на улице! Настоящая зима)) Вспоминается Бродский: «Поздно ночью, в уснувшей долине, на самом дне, в городке, занесенном снегом по ручку двери...»</p>
                    <span class="post-time">2 часа назад</span>
                </div>
            </div>

            <!-- Пост 2 -->
            <div class="post">
                <div class="post-header">
                    <div class="user">
                        <div class="user-avatar" id="lizadem"></div>
                        <span class="user-name">Лиза Дёмина</span>
                    </div>
                    <div class="edit-button"></div>
                </div>
                <img class="post-image" src="/images/v412_77.png" alt="Пост пользователя">
                <span class="span-reaction">
                    <button class="like-button">
                    </button>
                    204
                </span>
                <div class="post-content">
                    <span class="post-time">1 день назад</span>
                </div>
            </div>
        </main>

    </div>

</body>

</html>