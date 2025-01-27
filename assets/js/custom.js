const sliders = document.querySelectorAll('.slider-container');

sliders.forEach((slider) => {
    const beforeImage = slider.querySelector('.before-image');
    const sliderHandle = slider.querySelector('.slider-handle');

    let isDragging = false;

    const startDrag = () => {
        isDragging = true;
        slider.classList.add('active');
    };

    const stopDrag = () => {
        isDragging = false;
        slider.classList.remove('active');
    };

    const onDrag = (e) => {
        if (!isDragging) return;

        const clientX = e.touches ? e.touches[0].clientX : e.clientX;
        const rect = slider.getBoundingClientRect();
        const position = Math.max(0, Math.min(clientX - rect.left, rect.width));
        const percentage = (position / rect.width) * 100;

        beforeImage.style.clipPath = `inset(0 ${100 - percentage}% 0 0)`;
        sliderHandle.style.left = `${percentage}%`;
    };

    slider.addEventListener('mousedown', startDrag);
    slider.addEventListener('touchstart', startDrag);
    window.addEventListener('mousemove', onDrag);
    window.addEventListener('touchmove', onDrag);
    window.addEventListener('mouseup', stopDrag);
    window.addEventListener('touchend', stopDrag);
});
