
const modal = document.querySelector('.modal-container');
const modalCarousel = modal.querySelector('.modal-carousel');
const modalIndicator = modal.querySelector('.content__indicator');
const modalPrev = modal.querySelector('.post__carousel-button--prev');
const modalNext = modal.querySelector('.post__carousel-button--next');
const closeButton = document.querySelector('.content__close-button');
let modalCurrentIndex = 0;
let modalImages = [];

function showModalImage(index) {
    modalImages.forEach((img, i) => {
        img.style.display = (i === index) ? 'block' : 'none';
    });
    modalIndicator.textContent = `${index + 1} из ${modalImages.length}`
}

function handleEscape(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
}

function closeModal() {
    modal.style.display = 'none';
    document.removeEventListener('keydown', handleEscape);
}

closeButton.addEventListener('click', closeModal);

document.querySelectorAll('.post').forEach(post => {

    const images = post.querySelectorAll('.post__image');
    const indicator = post.querySelector('.post__indicator');
    const prevButton = post.querySelector('.post__carousel-button--prev');
    const nextButton = post.querySelector('.post__carousel-button--next');
    const post__carousel = post.querySelector('.post__carousel');
    let currentImageIndex = 0;

    function showImage(index) {
        images.forEach((img, i) => {
            img.style.display = (i === index) ? 'block' : 'none';
        });
        if (indicator) {
            indicator.textContent = `${index + 1} из  ${images.length}`;
        }
    }

    if (images.length > 0) {
        showImage(currentImageIndex);

        prevButton.addEventListener('click', e => {
            e.stopPropagation();
            currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
            showImage(currentImageIndex);
        });

        nextButton.addEventListener('click', e => {
            e.stopPropagation();
            currentImageIndex = (currentImageIndex + 1) % images.length;
            showImage(currentImageIndex);
        });
    }

    post__carousel.addEventListener('click', e => {
        modalCarousel.innerHTML = '';
        modalImages = [];

        images.forEach(img => {
            const clone = img.cloneNode(true);
            clone.className = 'modal-image';
            clone.style.display = 'none';
            modalCarousel.appendChild(clone);
            modalImages.push(clone);
        });

        modalCurrentIndex = currentImageIndex;
        if (modalImages.length > 0) {
            showModalImage(modalCurrentIndex);
        }

        modalPrev.onclick = (e) => {
            e.stopPropagation();
            modalCurrentIndex = (modalCurrentIndex - 1 + modalImages.length) % modalImages.length;
            showModalImage(modalCurrentIndex);
        };

        modalNext.onclick = (e) => {
            e.stopPropagation();
            modalCurrentIndex = (modalCurrentIndex + 1) % modalImages.length;
            showModalImage(modalCurrentIndex);
        };

        modal.style.display = 'flex';
        document.addEventListener('keydown', handleEscape); // Только при открытии
    });
});
