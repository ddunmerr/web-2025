document.addEventListener('DOMContentLoaded', function () {
    // Инициализация каруселей в ленте
    document.querySelectorAll('.post__carousel').forEach(initCarousel);
});

function initCarousel(carouselContainer) {
    const images = carouselContainer.querySelectorAll('.post__image');
    const indicator = carouselContainer.querySelector('.post__indicator');
    const prevButton = carouselContainer.querySelector('.post__carousel-button--prev');
    const nextButton = carouselContainer.querySelector('.post__carousel-button--next');
    let currentIndex = 0;

    // Инициализация индикатора
    if (indicator) {
        indicator.textContent = `1/${images.length}`;
    }

    // Показ текущего изображения
    function showImage(index) {
        images.forEach((img, i) => {
            img.style.display = i === index ? 'block' : 'none';
        });
        if (indicator) {
            indicator.textContent = `${index + 1}/${images.length}`;
        }
        // Сохраняем индекс для модального окна
        carouselContainer.dataset.currentIndex = index;
    }

    // Навигация
    if (prevButton && nextButton) {
        prevButton.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            showImage(currentIndex);
        });

        nextButton.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % images.length;
            showImage(currentIndex);
        });
    }

    // Инициализация первого изображения
    if (images.length > 0) {
        showImage(0);
    }
}