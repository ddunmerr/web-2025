<?php
require_once(__DIR__ . '/../source/databaseConnection.php');
$connection = connectDatabase();

$post = null;
$isEdit = false;

// Если передан id поста через GET
if (isset($_GET['id'])) {
    $postId = (int)$_GET['id'];
    $stmt = $connection->prepare("SELECT * FROM post WHERE id = :id");
    $stmt->execute([':id' => $postId]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($post) $isEdit = true;
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $isEdit ? 'Редактирование поста' : 'Новый пост' ?></title>
    <link rel="stylesheet" href="/css/addPost.css">
    <script src="/js/addPhoto.js" defer></script>
    <script src="/js/carousel.js" defer></script>
    <script>
        const isEdit = <?= $isEdit ? 'true' : 'false' ?>;
        const existingPost = <?= $post ? json_encode($post) : 'null' ?>;
    </script>
</head>

<body>
    <div class="page">
        <div class="sidebar">
            <ul class="sidebar__icons-list">
                <li><a class="sidebar__icon sidebar__icon--home" href="/pages/feed.php"></a></li>
                <li><a href="/pages/profile.php" class="sidebar__icon sidebar__icon--profile"></a></li>
                <li><a href="/pages/addPost.php" class="sidebar__icon sidebar__icon--add"></a></li>
            </ul>
        </div>

        <div class="header"></div>

        <form class="feed">
            <div class="photo-frame">
                <input type="file" id="photoInput" accept="image/*" multiple style="display: none;">
                <div class="add-photo-container">
                    <p class="picture-emoji">🖼</p>
                    <button type="button" class="add-button-first">Добавить фото</button>
                </div>
            </div>

            <button type="button" class="add-button-second">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M12.6667 2H3.33333C2.59695 2 2 2.59695 2 3.33333V12.6667C2 13.403 2.59695 14 3.33333 14H12.6667C13.403 14 14 13.403 14 12.6667V3.33333C14 2.59695 13.403 2 12.6667 2Z" stroke="#3F8AE0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M8 5.33398V10.6673" stroke="#3F8AE0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M5.33319 8H10.6665" stroke="#3F8AE0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Добавить фото
            </button>

            <textarea class="post-text" placeholder="Добавьте подпись..." maxlength="255"><?= $post['descr'] ?? '' ?></textarea>
            <button class="send-button"><?= $isEdit ? 'Сохранить' : 'Поделиться' ?></button>
        </form>
    </div>
</body>

</html>