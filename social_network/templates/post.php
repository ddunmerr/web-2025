<?php
$user = findUserInDatabase($connection, $post['id_user']);
if (!$user) return;
?>

<div class="post">
    <div class="post-header">
        <span class="post-author">
            <img class="user-avatar" src="<?= $user['avatar'] ?>">
            <a class="user-name" href="/pages/profile.php?id=<?= $user['id'] ?>">
                <?= $user['first_name'] . ' ' . $user['second_name'] ?>
            </a>
        </span>
        <button class="edit-button"></button>
    </div>
    <img class="post-image" src="<?= $post['image_1'] ?>" alt="Пост пользователя">
    <div class=".post-header">
        <button class="like-button">
            <img class="like-img" src="/icons/like.svg">
            <span class="like-counter"><?= $post['likes'] ?></span>
        </button>
    </div>
    <?php if (!empty($post['descr'])): ?>
        <p class="post-text"><?= $post['descr'] ?></p>
    <?php endif; ?>
    <p class="post-time"><?= date("d.m.Y H:i", strtotime($post['publish_date'])) ?></p>
</div>