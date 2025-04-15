<?php
$user = getUserById($users, $post['user_id']);
if (!$user) return;
?>

<div class="post">
    <div class="post-header">
        <span class="post-author">
            <img class="user-avatar" src="<?= htmlspecialchars($user['avatar']) ?>">
            <a class="user-name" href="/Pages/profile.php?id=<?php echo htmlspecialchars($user['id']) ?>"><?= htmlspecialchars($user['name']) ?></a>
        </span>
        <button class="edit-button"></button>
    </div>
    <img class="post-image" src="<?= htmlspecialchars($post['image']) ?>" alt="Пост пользователя">
    <button class="like-button">
        <img class="like-img" src="/icons/like.svg">
        <span class="like-counter"><?= htmlspecialchars($post['likes']) ?></span>
    </button>
    <?php if (!empty($post['text'])): ?>
        <p class="post-text"><?= htmlspecialchars($post['text']) ?></p>
    <?php endif; ?>
    <p class="post-time"><?= date("d.m.Y H:i", $post['timestamp']) ?></p>
</div>