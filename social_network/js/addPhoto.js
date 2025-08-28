// /js/addPhoto.js
const PostCreator = (() => {
    const MAX_IMAGES = 5;

    const photoInput = document.getElementById('photoInput');
    const frame = document.querySelector('.photo-frame');
    const addButtons = document.querySelectorAll('.add-button-first, .add-button-second');
    const sendButton = document.querySelector('.send-button');
    const postText = document.querySelector('.post-text');
    const feedForm = document.querySelector('.feed');

    let existingImages = []; // URL-ы из БД (при редактировании)
    let newFiles = [];       // новые выбранные файлы

    // Сообщение об ошибке
    const errorMsg = document.createElement('p');
    errorMsg.className = 'error-msg';
    errorMsg.style.color = 'red';
    errorMsg.style.fontSize = '16px';
    errorMsg.style.display = 'none';
    feedForm.appendChild(errorMsg);

    // --- Утилиты ---
    const showError = (msg) => { errorMsg.textContent = msg; errorMsg.style.display = 'block'; };
    const hideError = () => { errorMsg.textContent = ''; errorMsg.style.display = 'none'; };

    const createCarouselIfNotExists = () => {
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
        return carousel;
    };

    const renderCarousel = () => {
        const carousel = createCarouselIfNotExists();
        carousel.querySelectorAll('.post__image').forEach(img => img.remove());

        // 1) существующие (URL)
        existingImages.forEach(url => {
            const img = document.createElement('img');
            img.className = 'post__image';
            img.src = url;
            carousel.appendChild(img);
        });

        // 2) новые (File)
        newFiles.forEach(file => {
            const img = document.createElement('img');
            img.className = 'post__image';
            img.src = URL.createObjectURL(file);
            carousel.appendChild(img);
        });

        const total = existingImages.length + newFiles.length;
        carousel.style.display = total ? 'flex' : 'none';
        if (total) initCarousel(carousel); // ваша функция карусели
    };

    const updateSendButtonState = () => {
        const hasAnyImage = (existingImages.length + newFiles.length) > 0;
        sendButton.disabled = !(hasAnyImage && postText.value.trim());
        if (sendButton.disabled) {
            sendButton.textContent = isEdit ? 'Сохранить' : 'Поделиться';
        }
    };

    // --- Обработчики ---
    const onAddPhotoClick = (e) => {
        e.preventDefault();
        photoInput.click();
    };

    const onPhotoChange = () => {
        hideError();
        const picked = Array.from(photoInput.files || []);
        if (!picked.length) return;

        // Сколько ещё можно добрать
        const canAdd = MAX_IMAGES - existingImages.length - newFiles.length;
        if (canAdd <= 0) {
            showError(`Максимум ${MAX_IMAGES} фото!`);
            photoInput.value = '';
            return;
        }

        if (picked.length > canAdd) {
            showError(`Максимум ${MAX_IMAGES} фото!`);
        }

        newFiles = newFiles.concat(picked.slice(0, canAdd));
        photoInput.value = '';
        renderCarousel();
        updateSendButtonState();

        const addContainer = frame.querySelector('.add-photo-container');
        if (addContainer) addContainer.style.display = 'none';
    };

    const onTextInput = () => {
        hideError();
        updateSendButtonState();
    };

    const onSubmit = async (e) => {
        e.preventDefault();
        hideError();

        const total = existingImages.length + newFiles.length;
        if (!postText.value.trim() || total < 1) {
            return showError('Добавьте фото и текст!');
        }
        if (postText.maxLength && postText.value.length > postText.maxLength) {
            return showError(`Максимум ${postText.maxLength} символов в тексте!`);
        }

        const formData = new FormData();
        newFiles.forEach(file => formData.append('images[]', file));

        const payload = {
            descr: postText.value.trim()
        };

        if (isEdit && existingPost) {
            payload.id = existingPost.id;            // <-- ВАЖНО: даём серверу понять, что это UPDATE
        } else {
            payload.id_user = 1; // TODO: подставить текущего пользователя
        }

        formData.append('data', JSON.stringify(payload));

        sendButton.disabled = true;
        sendButton.textContent = isEdit ? 'Сохраняем...' : 'Сохраняем...';

        try {
            const res = await fetch('../api/api.php', { method: 'POST', body: formData });
            const result = await res.json();

            if (result.success) {
                // Поведение как в задании 1: скрываем интерфейс и показываем сообщение
                postText.style.display = 'none';
                sendButton.style.display = 'none';
                frame.style.display = 'none';
                addButtons.forEach(btn => btn.style.display = 'none');

                const successMsg = document.createElement('p');
                successMsg.textContent = isEdit ? 'Изменения сохранены!' : 'Пост успешно сохранён!';
                successMsg.style.fontSize = '18px';
                frame.parentNode.appendChild(successMsg);
            } else {
                showError(result.error || 'Ошибка при сохранении поста');
                sendButton.disabled = false;
                sendButton.textContent = isEdit ? 'Сохранить' : 'Поделиться';
            }
        } catch (err) {
            console.error(err);
            showError('Ошибка соединения с сервером');
            sendButton.disabled = false;
            sendButton.textContent = isEdit ? 'Сохранить' : 'Поделиться';
        }
    };

    // --- Инициализация ---
    const init = () => {
        sendButton.disabled = true;

        // Если редактирование — подставим изображения из existingPost
        if (typeof isEdit !== 'undefined' && isEdit && existingPost) {
            for (let i = 1; i <= 5; i++) {
                const url = existingPost[`image_${i}`];
                if (url) existingImages.push(url);
            }
            const addContainer = frame.querySelector('.add-photo-container');
            if (addContainer) addContainer.style.display = 'none';
            renderCarousel();
        }

        addButtons.forEach(btn => btn.addEventListener('click', onAddPhotoClick));
        photoInput.addEventListener('change', onPhotoChange);
        postText.addEventListener('input', onTextInput);
        feedForm.addEventListener('submit', onSubmit);

        updateSendButtonState();
    };

    return { init };
})();

document.addEventListener('DOMContentLoaded', () => PostCreator.init());
