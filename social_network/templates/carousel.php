<div class="post__carousel">
    <p class="post__indicator"></p>
    <?php for ($i = 1; $i <= 5; $i++): ?>
        <?php if (!empty($post["image_$i"])): ?>
            <img class="post__image" src="<?= $post["image_$i"] ?>" alt="Пост пользователя">
        <?php endif; ?>
    <?php endfor; ?>

    <button class="post__carousel-button post__carousel-button--prev"></button>
    <button class="post__carousel-button post__carousel-button--next"></button>

</div>