document.addEventListener("DOMContentLoaded", () => {
  const swiper = document.querySelectorAll(".wit-swiper-card");
  const swiperCardX = document.querySelectorAll(".wit-swiper-card_x");
  const swiperCardDate = document.querySelectorAll(".wit-swiper-card_date");
  const swiperGallery = document.querySelectorAll(".wit-swiper-gallery");
  const swiperVdo = document.querySelectorAll(".wit-swiper-vdo");

  swiper.forEach((item) => {
    const swiperCard = new Swiper(item, {
      slidesPerView: 1.2,
      spaceBetween: 24,
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
        992: {
          slidesPerView: 2.45,
        },
      },
    });
  });
  swiperCardX.forEach((item) => {
    const swiperCard = new Swiper(item, {
      slidesPerView: 1.8,
      spaceBetween: 8,
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
        992: {
          slidesPerView: 3.5,
        },
      },
    });
  });
  swiperCardDate.forEach((item) => {
    const swiperCard = new Swiper(item, {
      slidesPerView: 1.8,
      spaceBetween: 16,
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
        992: {
          slidesPerView: 2.74,
        },
      },
    });
  });
  swiperGallery.forEach((item) => {
    const swiperCard = new Swiper(item, {
      slidesPerView: 1,
      spaceBetween: 16,
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
    });
  });
  swiperVdo.forEach((item) => {
    const swiperCard = new Swiper(item, {
      slidesPerView: 2.7,
      spaceBetween: 16,
      navigation: {
        nextEl: item.parentElement.querySelector(
          ".wit-swiper-button .wit-swiper-button-next"
        ),
        prevEl: item.parentElement.querySelector(
          ".wit-swiper-button .wit-swiper-button-prev"
        ),
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

  const viewAll = document.querySelectorAll(".wit-link_view_all");
  viewAll.forEach((item) => {
    item.addEventListener("click", () => {
      const desc = item.parentElement.querySelector(".wit-desc");

      desc.classList.add("wit-link_view_all_active");
      item.classList.add("hidden");
    });
  });

  // Accordion
  const accordion = document.querySelectorAll(
    ".wit-accordion .wit-accordion-item .wit-accordion-header"
  );
  accordion.forEach((item) => {
    item.addEventListener("click", () => {
      item.parentElement.classList.toggle("wit-accordion-item_active");
      accordion.forEach((item_other) => {
        if (item_other.parentElement !== item.parentElement) {
          item_other.parentElement.classList.remove(
            "wit-accordion-item_active"
          );
        }
      });
    });
  });

  // Gallery Modal
  const galleryModal = document.getElementById("wit-gallery-modal");
  const galleryModalTrigger = document.querySelector(
    ".wit-gallery-modal-trigger"
  );
  const galleryModalClose = document.getElementById("wit-gallery-modal-close");
  const galleryModalOverlay = document.querySelector(
    ".wit-gallery-modal-overlay"
  );
  const galleryModalTabs = document.querySelectorAll(".wit-gallery-modal-tab");
  const galleryModalGrid = document.getElementById("wit-gallery-modal-grid");

  // Function to open modal
  function openGalleryModal() {
    galleryModal.classList.add("active");
    document.body.style.overflow = "hidden";

    // Reset to "All" tab and apply staggered layout
    galleryModalTabs.forEach((t) => t.classList.remove("active"));
    const allTab = document.querySelector(
      '.wit-gallery-modal-tab[data-category="all"]'
    );
    if (allTab) {
      allTab.classList.add("active");
    }

    // Apply staggered layout for "All" view
    setTimeout(() => {
      filterGallery("all");
    }, 100);
  }

  // Function to close modal
  function closeGalleryModal() {
    galleryModal.classList.remove("active");
    document.body.style.overflow = "";
  }

  // Event listeners
  if (galleryModalTrigger) {
    galleryModalTrigger.addEventListener("click", (e) => {
      e.preventDefault();
      openGalleryModal();
    });
  }

  if (galleryModalClose) {
    galleryModalClose.addEventListener("click", closeGalleryModal);
  }

  if (galleryModalOverlay) {
    galleryModalOverlay.addEventListener("click", closeGalleryModal);
  }

  // Function to filter gallery images by category
  function filterGallery(category) {
    const allItems = galleryModalGrid.querySelectorAll(
      ".wit-gallery-modal-item"
    );

    let visibleIndex = 0; // Counter for visible items

    allItems.forEach((item) => {
      const itemCategory = item.getAttribute("data-category");

      if (category === "all" || itemCategory === category) {
        item.style.display = "block";
        item.style.opacity = "0";

        // Reset transform first
        item.style.transform = "";

        // Animate in
        setTimeout(() => {
          item.style.transition = "all 0.3s ease";
          item.style.opacity = "1";

          // Apply translateY(-20px) to odd positioned items (1, 3, 5, 7...)
          if (visibleIndex % 2 === 0) {
            // visibleIndex starts from 0, so 0, 2, 4... are odd positions
            item.style.transform = "translateY(20px)";
          }

          visibleIndex++;
        }, 50);
      } else {
        item.style.transition = "all 0.3s ease";
        item.style.opacity = "0";

        // Hide after animation
        setTimeout(() => {
          item.style.display = "none";
        }, 300);
      }
    });
  }

  // Tab switching
  galleryModalTabs.forEach((tab) => {
    tab.addEventListener("click", () => {
      // Remove active class from all tabs
      galleryModalTabs.forEach((t) => t.classList.remove("active"));
      // Add active class to clicked tab
      tab.classList.add("active");
      // Filter images by category
      const category = tab.getAttribute("data-category");
      filterGallery(category);
    });
  });

  // Close modal with Escape key
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && galleryModal.classList.contains("active")) {
      closeGalleryModal();
    }
  });

  // Gallery Single Modal
  const gallerySingleModal = document.getElementById(
    "wit-gallery-single-modal"
  );
  const gallerySingleModalClose = document.getElementById(
    "wit-gallery-single-modal-close"
  );
  const gallerySingleModalOverlay = document.querySelector(
    ".wit-gallery-single-modal .wit-gallery-modal-overlay"
  );

  // Function to open gallery single modal
  function openGallerySingleModal() {
    console.log("Opening gallery single modal");
    gallerySingleModal.classList.add("active");
    document.body.style.overflow = "hidden";
  }

  // Function to close gallery single modal
  function closeGallerySingleModal() {
    console.log("Closing gallery single modal");
    gallerySingleModal.classList.remove("active");
    document.body.style.overflow = "";
  }

  // Gallery Single Modal Trigger
  const galleryModalSingleTrigger = document.querySelectorAll(
    ".wit-gallery-modal-single"
  );
  if (galleryModalSingleTrigger) {
    galleryModalSingleTrigger.forEach((item) => {
      item.addEventListener("click", (e) => {
        e.preventDefault();
        openGallerySingleModal();
      });
    });
  }

  // Close modal with close button
  if (gallerySingleModalClose) {
    gallerySingleModalClose.addEventListener("click", closeGallerySingleModal);
  }

  // Close modal with overlay click
  if (gallerySingleModalOverlay) {
    gallerySingleModalOverlay.addEventListener(
      "click",
      closeGallerySingleModal
    );
  }

  // Close modal with Escape key
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && gallerySingleModal.classList.contains("active")) {
      closeGallerySingleModal();
    }
  });

  const galleryModalSingle = document.querySelectorAll(
    ".wit-gallery-modal-single-swiper"
  );
  galleryModalSingle.forEach((item) => {
    // Initialize thumbnails swiper first
    const thumbnailsSwiper = new Swiper(
      item.parentElement.querySelector(".wit-swiper-gallery-thumbnails-swiper"),
      {
        slidesPerView: "auto",
        freeMode: true,
        watchSlidesProgress: true,
      }
    );

    // Initialize main swiper with thumbs
    const swiperCard = new Swiper(item, {
      slidesPerView: 1,
      spaceBetween: 0,
      navigation: {
        nextEl: item.parentElement.querySelector(
          ".wit-swiper-button.swiper-button-next"
        ),
        prevEl: item.parentElement.querySelector(
          ".wit-swiper-button.swiper-button-prev"
        ),
      },
      pagination: {
        el: ".wit-swiper-pagination",
        clickable: true,
      },
      thumbs: {
        swiper: thumbnailsSwiper,
      },
    });
  });

  // Video Modal
  const vdoModal = document.getElementById("wit-vdo-modal");
  const vdoModalClose = document.getElementById("wit-vdo-modal-close");
  const vdoModalOverlay = document.querySelector(
    ".wit-vdo-modal .wit-vdo-modal-overlay"
  );

  // Function to open video modal
  function openVdoModal() {
    console.log("Opening video modal");
    vdoModal.classList.add("active");
    document.body.style.overflow = "hidden";
  }

  // Function to close video modal
  function closeVdoModal() {
    console.log("Closing video modal");
    vdoModal.classList.remove("active");
    document.body.style.overflow = "";
  }

  // Video Modal Trigger
  const vdoModalTrigger = document.querySelector(".wit-vdo-modal-trigger");
  if (vdoModalTrigger) {
    vdoModalTrigger.addEventListener("click", (e) => {
      e.preventDefault();
      openVdoModal();
    });
  }

  // Close modal with close button
  if (vdoModalClose) {
    vdoModalClose.addEventListener("click", closeVdoModal);
  }

  // Close modal with overlay click
  if (vdoModalOverlay) {
    vdoModalOverlay.addEventListener("click", closeVdoModal);
  }

  // Close modal with Escape key
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && vdoModal.classList.contains("active")) {
      closeVdoModal();
    }
  });
});

// Vdo Single Modal functionality
document.addEventListener("DOMContentLoaded", () => {
  const vdoSingleModal = document.getElementById("wit-vdo-single-modal");
  const vdoSingleModalClose = document.getElementById(
    "wit-vdo-single-modal-close"
  );
  const vdoSingleModalOverlay = document.querySelector(
    ".wit-vdo-single-modal .wit-vdo-modal-overlay"
  );
  let vdoSingleSwiper = null;
  let vdoSingleThumbnailsSwiper = null;

  // Open vdo single modal
  const openVdoSingleModal = (index = 0) => {
    if (vdoSingleModal) {
      vdoSingleModal.classList.add("active");
      document.body.style.overflow = "hidden";

      // Initialize swipers only if not already initialized
      if (!vdoSingleThumbnailsSwiper) {
        vdoSingleThumbnailsSwiper = new Swiper(
          ".wit-vdo-single-modal .wit-swiper-vdo-thumbnails-swiper",
          {
            slidesPerView: "auto",
            freeMode: true,
            watchSlidesProgress: true,
          }
        );
      }

      if (!vdoSingleSwiper) {
        vdoSingleSwiper = new Swiper(
          ".wit-vdo-single-modal .wit-vdo-modal-single-swiper",
          {
            slidesPerView: 1,
            spaceBetween: 0,
            navigation: {
              nextEl:
                ".wit-vdo-single-modal .wit-swiper-button.swiper-button-next",
              prevEl:
                ".wit-vdo-single-modal .wit-swiper-button.swiper-button-prev",
            },
            pagination: {
              el: ".wit-vdo-single-modal .wit-swiper-pagination",
              clickable: true,
            },
            thumbs: {
              swiper: vdoSingleThumbnailsSwiper,
            },
          }
        );
      }

      // Update swiper size after modal is shown
      setTimeout(() => {
        if (vdoSingleSwiper) {
          vdoSingleSwiper.updateSize();
          vdoSingleSwiper.updateSlides();
        }
        if (vdoSingleThumbnailsSwiper) {
          vdoSingleThumbnailsSwiper.updateSize();
          vdoSingleThumbnailsSwiper.updateSlides();
        }
      }, 100);

      // Go to specific slide if index provided
      if (index > 0 && vdoSingleSwiper) {
        setTimeout(() => {
          vdoSingleSwiper.slideTo(index);
        }, 200);
      }
    }
  };

  // Close vdo single modal
  const closeVdoSingleModal = () => {
    if (vdoSingleModal) {
      vdoSingleModal.classList.remove("active");
      document.body.style.overflow = "";

      // Pause all videos when closing modal
      const iframes = vdoSingleModal.querySelectorAll("iframe");
      iframes.forEach((iframe) => {
        iframe.src = iframe.src; // Reload to pause video
      });
    }
  };

  // Event listeners for vdo single modal
  if (vdoSingleModalClose) {
    vdoSingleModalClose.addEventListener("click", closeVdoSingleModal);
  }

  if (vdoSingleModalOverlay) {
    vdoSingleModalOverlay.addEventListener("click", closeVdoSingleModal);
  }

  // Close modal with Escape key
  document.addEventListener("keydown", (e) => {
    if (
      e.key === "Escape" &&
      vdoSingleModal &&
      vdoSingleModal.classList.contains("active")
    ) {
      closeVdoSingleModal();
    }
  });

  // Add click listeners to vdo modal items
  const vdoModalItems = document.querySelectorAll(".wit-vdo-modal-item");
  vdoModalItems.forEach((item, index) => {
    item.addEventListener("click", () => {
      // Open vdo single modal with specific index
      openVdoSingleModal(index);
    });
  });

  const vdoModalSingle = document.querySelector(".wit-vdo-modal-single");
  if (vdoModalSingle) {
    vdoModalSingle.addEventListener("click", (e) => {
      e.preventDefault();
      openVdoSingleModal();
    });
  }
});
