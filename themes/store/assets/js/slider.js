const upBtn = document.getElementById('up-btn');
const downBtn = document.getElementById('down-btn');
const slider = document.querySelector('.slider');
const slides = document.querySelectorAll('.slide');
const slideHeight = 135; // Высота одного слайда
const visibleSlides = 3;
let currentPosition = 0;
const totalSlides = slides.length;

upBtn.addEventListener('click', () => {
    if (currentPosition > 0) {
        currentPosition--;
        slider.style.transform = `translateY(-${currentPosition * slideHeight}px)`;
    }
});

downBtn.addEventListener('click', () => {
    if (currentPosition < totalSlides - visibleSlides) {
        currentPosition++;
        slider.style.transform = `translateY(-${currentPosition * slideHeight}px)`;
    }
});
