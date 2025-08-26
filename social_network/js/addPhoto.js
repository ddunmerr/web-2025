const photoInput = document.getElementById('photoInput');
const frame = document.querySelector('.photo-frame');
const addButtonFirst = document.querySelector('.add-button-first');
const addButtonSecond = document.querySelector('.add-button-second');
const sendButton = document.querySelector('.send-button');
const postText = document.querySelector('.post-text');
const feedForm = document.querySelector('.feed');

let selectedFiles = [];

let errorMsg = document.createElement('p');
errorMsg.style.color = 'red';
errorMsg.style.fontSize = '16px';
errorMsg.style.display = 'none';
feedForm.appendChild(errorMsg);

sendButton.disabled = true;

// Кнопки добавления фото
[addButtonFirst, addButtonSecond].forEach(button => {
    button.addEventListener('click', e => {
        e.preventDefault();
        photoInput.click();
    });
});

// Рендер карусели
function renderCarousel(files) {
    let carousel = frame.querySelector('.post__carousel');

    if (!carousel) {
        carousel = document.createElement('div');
        carousel.className = 'post__carousel';
        carousel.innerHTML = `
            <p class="post__indicator"></p>
            <button type="button" class="post__carousel-button post__carousel-button--prev"></button>
            <button type="button" class="post__carousel-button post__carousel-button--next"></button>
        `;
        frame.appendChild(carousel);
    }

    // Очистка старых картинок
    carousel.querySelectorAll('.post__image').forEach(img => img.remove());

    files.forEach(file => {
        const img = document.createElement('img');
        img.className = 'post__image';
        img.src = URL.createObjectURL(file);
        carousel.appendChild(img);
    });

    carousel.style.display = files.length ? 'flex' : 'none';
    if (files.length) initCarousel(carousel);
}

// При выборе фото
photoInput.addEventListener('change', function () {
    errorMsg.style.display = 'none';
    errorMsg.textContent = '';

    const files = Array.from(photoInput.files);
    if (!files.length) return;

    selectedFiles = selectedFiles.concat(files);
    if (selectedFiles.length > 5) {
        selectedFiles = selectedFiles.slice(0, 5);
        errorMsg.textContent = 'Максимум 5 фото!';
        errorMsg.style.display = 'block';
    }

    renderCarousel(selectedFiles);
    photoInput.value = '';

    updateSendButtonState();

    const addContainer = frame.querySelector('.add-photo-container');
    if (addContainer) addContainer.style.display = 'none';
});

// Скрытие ошибки при вводе текста
postText.addEventListener('input', () => {
    if (errorMsg.style.display === 'block') {
        errorMsg.style.display = 'none';
        errorMsg.textContent = '';
    }
    updateSendButtonState();
});

// Активация кнопки отправки
function updateSendButtonState() {
    sendButton.disabled = !(selectedFiles.length && postText.value.trim());
}

// Отправка поста
feedForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    errorMsg.style.display = 'none';
    errorMsg.textContent = '';

    if (!postText.value.trim() || selectedFiles.length < 1) {
        errorMsg.textContent = 'Добавьте фото и текст!';
        errorMsg.style.display = 'block';
        return;
    }

    if (postText.value.length > 500) {
        errorMsg.textContent = 'Максимум 500 символов в тексте!';
        errorMsg.style.display = 'block';
        return;
    }

    const formData = new FormData();
    selectedFiles.forEach(file => formData.append('images[]', file));
    formData.append('data', JSON.stringify({
        descr: postText.value.trim(),
        id_user: 1 // заменить на текущего пользователя
    }));

    sendButton.disabled = true;
    sendButton.textContent = 'Сохраняем...';

    try {
        const res = await fetch('../api/api.php', { method: 'POST', body: formData });
        const result = await res.json();

        if (result.success) {
            postText.style.display = 'none';
            sendButton.style.display = 'none';
            frame.style.display = 'none';
            addButtonSecond.style.display = 'none';

            const successMsg = document.createElement('p');
            successMsg.textContent = 'Пост успешно сохранен!';
            successMsg.style.fontSize = '18px';
            frame.parentNode.appendChild(successMsg);
        } else {
            errorMsg.textContent = result.error || 'Ошибка при сохранении поста';
            errorMsg.style.display = 'block';
            sendButton.disabled = false;
            sendButton.textContent = 'Поделиться';
        }
    } catch (err) {
        console.error(err);
        errorMsg.textContent = 'Ошибка соединения с сервером';
        errorMsg.style.display = 'block';
        sendButton.disabled = false;
        sendButton.textContent = 'Поделиться';
    }
});
