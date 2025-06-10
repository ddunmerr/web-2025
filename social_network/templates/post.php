<?php
$user = findUserInDatabase($connection, $post['id_user']);
if (!$user) {
    echo "<!-- пользователь не найден -->";
    return;
}
?>

<div class="post" data-post-id="<?= $post['id'] ?>">
    <div class="post__header">
        <span class="post__author">
            <img class="post__user-avatar" src="<?= $user['avatar'] ?>">
            <a class="post__user-name" href="/pages/profile.php?id=<?= $user['id'] ?>">
                <?= $user['first_name'] . ' ' . $user['second_name'] ?>
            </a>
        </span>
        <button class="post__edit-button"></button>
    </div>
    <?php
    require(__DIR__ . '/../templates/carousel.php');
    ?>
    <div class="post__footer">
        <button class="post__like-button">
            <img class="post__like-img" src="/icons/like.svg">
            <span class="post__like-counter"><?= $post['likes'] ?></span>
        </button>
    </div>
    <?php if (!empty($post['descr'])): ?>
        <div class="post__text-wrapper">
            <p class="post__descr"><?= htmlspecialchars($post['descr']) ?></p>
            <button class="post__toggle-btn" style="display: none;">ещё</button>
        </div>
    <?php endif; ?>
    <p class="post__time"><?= date("d.m.Y H:i", strtotime($post['publish_date'])) ?></p>
</div>