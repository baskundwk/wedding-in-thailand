document.addEventListener("DOMContentLoaded", () => {
  const swiper = document.querySelectorAll(".wit-swiper-card");

  swiper.forEach((item) => {
    const swiperCard = new Swiper(item, {
      slidesPerView: item.classList.contains("wit-swiper-card_col4")
        ? 1.4
        : 1.13,
      spaceBetween: item.classList.contains("wit-swiper-card_col4") ? 16 : 24,
      navigation: {
        nextEl: item.parentElement.querySelector(
          ".wit-swiper-button .wit-swiper-button-next"
        ),
        prevEl: item.parentElement.querySelector(
          ".wit-swiper-button .wit-swiper-button-prev"
        ),
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },

      breakpoints: {
        450: {
          slidesPerView: item.classList.contains("wit-swiper-card_col4")
            ? 2.2
            : 1.5,
        },
        767: {
          slidesPerView: item.classList.contains("wit-swiper-card_col4")
            ? 3.2
            : 2.5,
        },
        992: {
          slidesPerView: item.classList.contains("wit-swiper-card_col4")
            ? 3.65
            : 3.2,
        },
        1200: {
          slidesPerView: item.classList.contains("wit-swiper-card_col4")
            ? 4.5
            : 3.65,
          spaceBetween: 16,
        },
      },
    });
  });

  const swiperCardImg = new Swiper(".wit-swiper-card_img", {
    nested: true,
    slidesPerView: 1,
    spaceBetween: 16,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
  });
});
