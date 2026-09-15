const slides = document.querySelectorAll(".slide");
const nextBtn = document.querySelector(".next");
const prevBtn = document.querySelector(".prev");

let current = 0;
const visibleSlides = 2;
const lastSlide = Math.max(0, slides.length - visibleSlides);

function showSlide(index) {
  current = Math.min(Math.max(index, 0), lastSlide);
  document.querySelector(".slides").style.transform = `translateX(-${current * 50}%)`;
}

nextBtn.addEventListener("click", () => {
  current = current >= lastSlide ? 0 : current + 1;
  showSlide(current);
});

prevBtn.addEventListener("click", () => {
  current = current <= 0 ? lastSlide : current - 1;
  showSlide(current);
});

// Auto slide every 5 seconds
setInterval(() => {
  current = current >= lastSlide ? 0 : current + 1;
  showSlide(current);
}, 5000);