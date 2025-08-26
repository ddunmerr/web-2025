document.querySelectorAll('.post__text-wrapper').forEach(wrapper => {
    const textElement = wrapper.querySelector('.post__descr');
    const button = wrapper.querySelector('.post__reveal-button');

    const maxLength = 100;
    const fullText = textElement.textContent;

    if (fullText.length <= maxLength) {
        button.style.display = 'none';
        return;
    }
    textElement.textContent = fullText.slice(0, maxLength) + '...';
    let expanded = false;

    button.addEventListener('click', () => {
        expanded = !expanded;
        if (expanded) {
            textElement.textContent = fullText;
            button.textContent = 'свернуть';
        } else {
            textElement.textContent = fullText.slice(0, maxLength) + '...';
            button.textContent = 'ещё';
        }
    });
});
