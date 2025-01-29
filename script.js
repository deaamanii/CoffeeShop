let currentSlide = 0;
const slides = document.querySelectorAll(".slide");

function showSlide(index) {
    if (index >= slides.length) {
        currentSlide = 0;
    } else if (index < 0) {
        currentSlide = slides.length - 1;
    } else {
        currentSlide = index;
    }

    document.querySelector(".slides").style.transform = `translateX(-${currentSlide * 100}%)`;
}

document.querySelector(".next").addEventListener("click", () => showSlide(currentSlide + 1));
document.querySelector(".prev").addEventListener("click", () => showSlide(currentSlide - 1));

showSlide(currentSlide);



