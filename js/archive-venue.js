document.addEventListener("DOMContentLoaded", () => {
  const swiper = new Swiper(".wit-card_with_btn-img_swiper", {
    slidesPerView: 1,
    spaceBetween: 16,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
  });
});
