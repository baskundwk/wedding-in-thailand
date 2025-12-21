document.addEventListener("DOMContentLoaded", () => {
  // Unified Swiper initialization function
  const initSwiper = (selector, defaultConfig = {}) => {
    const swipers = document.querySelectorAll(selector);
    
    swipers.forEach((item) => {
      const slides = item.dataset.slides || defaultConfig.slidesPerView || 1;
      const space = parseInt(item.dataset.space) || defaultConfig.spaceBetween || 16;
      const breakpoints = item.dataset.breakpoints ? JSON.parse(item.dataset.breakpoints) : defaultConfig.breakpoints || {};
      const nested = item.dataset.nested === 'true' || defaultConfig.nested || false;
      
      const config = {
        slidesPerView: parseFloat(slides),
        spaceBetween: space,
        nested: nested,
        navigation: {
          nextEl: item.parentElement.querySelector(".wit-swiper-button .wit-swiper-button-next"),
          prevEl: item.parentElement.querySelector(".wit-swiper-button .wit-swiper-button-prev"),
        },
        pagination: {
          el: item.querySelector(".swiper-pagination") || ".swiper-pagination",
          clickable: true,
        },
        breakpoints: breakpoints,
        nested: nested,
      };
      
      new Swiper(item, config);
    });
  };

  // Initialize all standard swipers
  initSwiper('.wit-swiper');
  
  // Initialize nested image swipers (backwards compatibility)
  initSwiper('.wit-swiper-card_img', {
    slidesPerView: 1,
    spaceBetween: 0,
    breakpoints: {},
    nested: true,
  });
});

