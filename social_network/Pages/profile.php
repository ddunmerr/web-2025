<?php
require_once(__DIR__ . '/../source/databaseConnection.php');

$connection = connectDatabase();

if (isset($_GET['id'])) {
    $userId = (int)$_GET['id'];
} else {
    header('Location: /pages/feed.php');
    exit;
}

$user = findUserInDatabase($connection, $userId);
if (!$user) {
    header('Location: /pages/feed.php');
    exit;
}

$userPosts = getUserPosts($connection, $userId);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <title>Профиль</title>
    <link rel="stylesheet" href="/css/profile.css">
</head>

<body>
    <div class="page">
        <!-- Сайдбар -->
        <div class="sidebar">
            <ul class="sidebar__icons-list">
                <li><a class="sidebar__icon sidebar__icon--home" href="/pages/feed.php"></a></li>
                <li><a class="sidebar__icon sidebar__icon--profile" href="/pages/profile.php"></a></li>
                <li><a class="sidebar__icon sidebar__icon--add" href="/pages/addPost.php"></a></li>
            </ul>
        </div>

        <!-- Шапка -->
        <div class="main-header"></div>

        <!-- Шапка профиля -->
        <div class="profile-header">
            <img class="profile-header__avatar" src="<?= $user['avatar'] ?>" alt="Аватар">
            <h1 class="profile-header__name"><?= $user['first_name'] . ' ' . $user['second_name'] ?></h1>
            <p class="profile-header__description"><?= $user['descr'] ?></p>

            <div class="profile-header__posts-count">
                <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.1668 2H3.83346C3.09708 2 2.50012 2.59695 2.50012 3.33333V12.6667C2.50012 13.403 3.09708 14 3.83346 14H13.1668C13.9032 14 14.5001 13.403 14.5001 12.6667V3.33333C14.5001 2.59695 13.9032 2 13.1668 2Z" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M6.16614 6.66797C6.71842 6.66797 7.16614 6.22025 7.16614 5.66797C7.16614 5.11568 6.71842 4.66797 6.16614 4.66797C5.61385 4.66797 5.16614 5.11568 5.16614 5.66797C5.16614 6.22025 5.61385 6.66797 6.16614 6.66797Z" fill="#222222" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M14.5008 10.0013L11.1674 6.66797L3.83411 14.0013" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="profile-header__counter"><?= count($userPosts) ?> постов</span>
            </div>
        </div>

        <!-- Стена профиля -->
        <div class="wall">
            <?php foreach ($userPosts as $post): ?>
                <img class="wall__image" src="<?= $post['image_1'] ?>" alt="/images/image.png">
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>