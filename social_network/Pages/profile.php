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
    <title>Профиль</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <div class="container">
        <!-- Сайдбар -->
        <div class="sidebar">
            <div class="icons-list">
                <ul>
                    <li><a href="/pages/feed.php" class="icon icon--home"></a></li>
                    <li><a class="icon icon--profile"></a></li>
                    <li><a class="icon icon--add"></a></li>
                </ul>
            </div>
        </div>
        <!-- Шапка -->
        <div class="header"></div>

        <!-- Шапка профиля -->
        <div class="profile-header">
            <img src="/images/v412_71.png" class="profile-avatar">
            <div class="profile-name">
                <h1>Ваня Денисов</h1>
            </div>
            <div class="profile-description">
                <p>Привет! Я системный аналитик в ACME :) Тут моя жизнь только для самых классных!</p>
            </div>
            <div class="posts-count">
                <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.1668 2H3.83346C3.09708 2 2.50012 2.59695 2.50012 3.33333V12.6667C2.50012 13.403 3.09708 14 3.83346 14H13.1668C13.9032 14 14.5001 13.403 14.5001 12.6667V3.33333C14.5001 2.59695 13.9032 2 13.1668 2Z" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M6.16614 6.66797C6.71842 6.66797 7.16614 6.22025 7.16614 5.66797C7.16614 5.11568 6.71842 4.66797 6.16614 4.66797C5.61385 4.66797 5.16614 5.11568 5.16614 5.66797C5.16614 6.22025 5.61385 6.66797 6.16614 6.66797Z" fill="#222222" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M14.5008 10.0013L11.1674 6.66797L3.83411 14.0013" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p>43 поста</p>
            </div>
        </div>
        <!-- Стена профиля -->
        <main class="wall">
            <img src="/images/1.png">
            <img src="/images/2.png">
            <img src="/images/3.png">
            <img src="/images/4.png">
            <img src="/images/5.png">
            <img src="/images/6.png">
            <img src="/images/7.png">
            <img src="/images/8.png">
            <img src="/images/9.png">
        </main>

    </div>

</body>

</html>