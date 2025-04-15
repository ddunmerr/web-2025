<?php
$users = json_decode(file_get_contents(__DIR__ . '/../json/users.json'), true);
$posts = json_decode(file_get_contents(__DIR__ . '/../json/posts.json'), true);

function getUserById($users, $id)
{
    foreach ($users as $user) {
        if ($user['id'] == $id) return $user;
    }
    return null;
}

if (isset($_GET['id'])) {
    $userId = (int)$_GET['id'];
} else {
    header('Location: /Pages/feed.php');
}

$user = getUserById($users, $userId);
if (!$user) header('Location: /Pages/feed.php');


$userPosts = array_filter($posts, fn($post) => $post['user_id'] == $userId);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль</title>
    <link rel="stylesheet" href="/css/profile.css">
</head>

<body>
    <div class="page">
        <!-- Сайдбар -->
        <div class="sidebar">
            <ul class="icons-list">
                <li><a class="icon icon--home" href="/pages/feed.php"></a></li>
                <li><a href="/pages/profile.php" class="icon icon--profile"></a></li>
                <li><a class="icon icon--add"></a></li>
            </ul>
        </div>

        <!-- Шапка -->
        <div class="header"></div>

        <!-- Шапка профиля -->
        <div class="profile-header">
            <img src="<?= htmlspecialchars($user['avatar']) ?>" alt="Аватар" class="profile-avatar">
            <h1 class="profile-name"><?= htmlspecialchars($user['name']) ?></h1>
            <p class="profile-description"><?= htmlspecialchars($user['description']) ?></p>

            <div class="posts-count">
                <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.1668 2H3.83346C3.09708 2 2.50012 2.59695 2.50012 3.33333V12.6667C2.50012 13.403 3.09708 14 3.83346 14H13.1668C13.9032 14 14.5001 13.403 14.5001 12.6667V3.33333C14.5001 2.59695 13.9032 2 13.1668 2Z" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M6.16614 6.66797C6.71842 6.66797 7.16614 6.22025 7.16614 5.66797C7.16614 5.11568 6.71842 4.66797 6.16614 4.66797C5.61385 4.66797 5.16614 5.11568 5.16614 5.66797C5.16614 6.22025 5.61385 6.66797 6.16614 6.66797Z" fill="#222222" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M14.5008 10.0013L11.1674 6.66797L3.83411 14.0013" stroke="#222222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="count-p"><?= count($userPosts) ?> постов</span>
            </div>
        </div>

        <!-- Стена профиля -->
        <div class="wall">
            <?php foreach ($userPosts as $post): ?>
                <img class="wall-img" src="<?= htmlspecialchars($post['image']) ?>" alt="/images/image.png">
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>