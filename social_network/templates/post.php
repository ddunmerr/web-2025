<?php
$user = findUserInDatabase($connection, $post['id_user']);
if (!$user) {
    echo "<!-- пользователь не найден -->";
    return;
}
?>

<div class="post">
    <div class="post__header">
        <span class="post__author">
            <img class="post__user-avatar" src="<?= $user['avatar'] ?>">
            <a class="post__user-name" href="/pages/profile.php?id=<?= $user['id'] ?>">
                <?= $user['first_name'] . ' ' . $user['second_name'] ?>
            </a>
        </span>
        <button class="post__edit-button"></button>
    </div>
    <img class="post__image" src="<?= $post['image_1'] ?>" alt="Пост пользователя">
    <div class="post__footer">
        <button class="post__like-button">
            <img class="post__like-img" src="/icons/like.svg">
            <span class="post__like-counter"><?= $post['likes'] ?></span>
        </button>
    </div>
    <?php if (!empty($post['descr'])): ?>
        <p class="post__descr"><?= $post['descr'] ?></p>
    <?php endif; ?>
    <p class="post__time"><?= date("d.m.Y H:i", strtotime($post['publish_date'])) ?></p>
</div>