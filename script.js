document.addEventListener("DOMContentLoaded", () => {
    let currentSlide = 0;
    const slides = document.querySelectorAll(".slide");
    const slidesContainer = document.querySelector(".slides");
    const nextButton = document.querySelector(".next");
    const prevButton = document.querySelector(".prev");

    if (!slidesContainer || slides.length === 0 || !nextButton || !prevButton) {
        console.error("Slider elements not found.");
        return;
    }

    function showSlide(index) {
        if (index >= slides.length) {
            currentSlide = 0;
        } else if (index < 0) {
            currentSlide = slides.length - 1;
        } else {
            currentSlide = index;
        }

        slidesContainer.style.transform = `translateX(-${currentSlide * 100}%)`;
    }

    function changeSlide(step) {
        showSlide(currentSlide + step);
    }

    nextButton.addEventListener("click", () => changeSlide(1));
    prevButton.addEventListener("click", () => changeSlide(-1));

    setInterval(() => {
        changeSlide(1);
    }, 1800); 

    showSlide(currentSlide);
});
