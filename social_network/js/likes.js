document.querySelectorAll('.like-button').forEach(button => {
    button.addEventListener('click', () => {
        const post = button.closest('.post');
        const postId = post.dataset.postId;
        const icon = button.querySelector('.like-icon');
        const countEl = button.querySelector('.like-count');

        fetch('/like.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `id=${postId}`
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    icon.textContent = data.liked ? '❤️' : '♡';
                    countEl.textContent = data.likes;
                    alert(data.liked ? 'Вы лайкнули этот пост!' : 'Вы убрали лайк с этого поста!');
                } else {
                    alert('Ошибка при обновлении лайка: ' + (data.error || 'неизвестная ошибка'));
                }
            })
            .catch(() => {
                alert('Ошибка соединения с сервером');
            });
    });
});