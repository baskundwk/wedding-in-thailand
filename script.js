/* Theme */
  const headerMobileToggle = document.querySelector('.wit-header-mobile-toggle')

  headerMobileToggle?.addEventListener('click', function() {
    const headerLower = document.querySelector('.wit-header-lower')
    headerLower.classList.toggle('active')
  })

  //Floating Debugger
  const floatingDebugger = document.querySelector('.floating-debugger')
  const floatingDebuggerToggle = document.querySelector('.floating-debugger-toggle')

  floatingDebuggerToggle?.addEventListener('click', function() {
    floatingDebugger.classList.toggle('active')
  })

/* 
 * Unified Swiper Implementation
 * =============================
 * Use the .wit-swiper class with data attributes for all swiper instances:
 * 
 * Data Attributes:
 * - data-slides: Number of slides to show (e.g., "1.2", "2.5", "1")
 * - data-space: Space between slides in pixels (e.g., "16", "24")
 * - data-breakpoints: JSON string with responsive breakpoints
 * - data-nested: "true" for nested swipers
 * - data-loop: "true" to enable loop mode
 * - data-autoplay: Milliseconds for autoplay delay (e.g., "3000")
 * 
 * Example:
 * <div class="swiper wit-swiper" 
 *      data-slides="1.2" 
 *      data-space="24" 
 *      data-breakpoints='{"768":{"slidesPerView":2.5},"992":{"slidesPerView":3.2}}'>
 */
/* Single Venue */
  document.addEventListener("DOMContentLoaded", () => {
    // Unified Swiper initialization function
    const initSwiper = (selector, defaultConfig = {}) => {
      const swipers = document.querySelectorAll(selector);
      
      swipers.forEach((item) => {
        // Get data attributes
        const slides = item.dataset.slides || defaultConfig.slidesPerView || 1;
        const space = parseInt(item.dataset.space) || defaultConfig.spaceBetween || 16;
        const breakpoints = item.dataset.breakpoints ? JSON.parse(item.dataset.breakpoints) : defaultConfig.breakpoints || {};
        const nested = item.dataset.nested === 'true' || defaultConfig.nested || false;
        const loop = item.dataset.loop === 'true';
        const autoplay = item.dataset.autoplay ? { delay: parseInt(item.dataset.autoplay), disableOnInteraction: false } : false;
        
        const config = {
          slidesPerView: parseFloat(slides),
          spaceBetween: space,
          nested: nested,
          loop: loop,
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
        
        if (autoplay) {
          config.autoplay = autoplay;
        }
        
        new Swiper(item, config);
      });
    };

    // Initialize all standard swipers with data attributes
    initSwiper('.wit-swiper');
    
    // Initialize nested image swipers (backwards compatibility)
    initSwiper('.wit-swiper-card_img', {
      slidesPerView: 1,
      spaceBetween: 0,
      breakpoints: {},
      nested: true,
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
      document.documentElement.style.overflow = "hidden";
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
      document.documentElement.style.overflow = "";
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
      document.documentElement.style.overflow = "hidden";
      document.body.style.overflow = "hidden";
    }

    // Function to close gallery single modal
    function closeGallerySingleModal() {
      console.log("Closing gallery single modal");
      gallerySingleModal.classList.remove("active");
      document.documentElement.style.overflow = "";
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

    // Gallery Modal Single Swiper (needs special thumbnails handling)
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
      new Swiper(item, {
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
      document.documentElement.style.overflow = "hidden";
      document.body.style.overflow = "hidden";
    }

    // Function to close video modal
    function closeVdoModal() {
      console.log("Closing video modal");
      vdoModal.classList.remove("active");
      document.documentElement.style.overflow = "";
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

    // Header Venue Swiper - Initialize based on screen size
    let headerVenueSwiper = null;

    function initHeaderVenueSwiper() {
      if (window.innerWidth >= 768) {
        if (!headerVenueSwiper) {
          const headerElement = document.querySelector(".wit-section-header_venue_swiper");
          if (headerElement) {
            headerVenueSwiper = new Swiper(headerElement, {
              slidesPerView: 1,
              spaceBetween: 0,
              loop: true,
              autoplay: {
                delay: 3000,
                disableOnInteraction: false,
              },
              navigation: {
                nextEl: ".wit-section-header_venue_swiper .swiper-button-next",
                prevEl: ".wit-section-header_venue_swiper .swiper-button-prev",
              },
              pagination: {
                el: ".wit-section-header_venue_swiper .swiper-pagination",
                clickable: true,
              },
            });
          }
        }
      } else {
        if (headerVenueSwiper) {
          headerVenueSwiper.destroy(true, true);
          headerVenueSwiper = null;
        }
      }
    }

    // Initialize on load
    initHeaderVenueSwiper();

    // Handle resize
    window.addEventListener("resize", initHeaderVenueSwiper);
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

    // Initialize vdo single swipers based on screen size
    function initVdoSingleSwipers() {
      if (window.innerWidth >= 768) {
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
      } else {
        // Destroy swipers on mobile
        if (vdoSingleSwiper) {
          vdoSingleSwiper.destroy(true, true);
          vdoSingleSwiper = null;
        }
        if (vdoSingleThumbnailsSwiper) {
          vdoSingleThumbnailsSwiper.destroy(true, true);
          vdoSingleThumbnailsSwiper = null;
        }
      }
    }

    // Open vdo single modal
    const openVdoSingleModal = (index = 0) => {
      if (vdoSingleModal) {
        vdoSingleModal.classList.add("active");
        document.documentElement.style.overflow = "hidden";
        document.body.style.overflow = "hidden";

        // Initialize swipers based on screen size
        initVdoSingleSwipers();

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
        document.documentElement.style.overflow = "";
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

    // Handle resize for vdo single modal
    window.addEventListener("resize", () => {
      if (vdoSingleModal && vdoSingleModal.classList.contains("active")) {
        initVdoSingleSwipers();
      }
    });
  });

/* Archive Venue */
  document.addEventListener("DOMContentLoaded", () => {
    // Unified Swiper initialization - reuse the same function
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



// General tabs functionality
document.addEventListener("DOMContentLoaded", () => {
  const tabContainers = document.querySelectorAll(".wit-tabs");

  tabContainers.forEach((container) => {
    const tabs = container.querySelectorAll(".wit-tab");
    const tabContents = container.querySelectorAll(".wit-tab-content");

    tabs.forEach((tab, index) => {
      tab.addEventListener("click", () => {
        // Remove active class from all tabs and contents
        tabs.forEach((t) => t.classList.remove("active"));
        tabContents.forEach((content) =>
          content.classList.remove("wit-tab-content_active")
        );

        // Add active class to clicked tab and corresponding content
        tab.classList.add("active");
        const tabTarget = tab.getAttribute("data-target");
        const targetContent = container.querySelector(`.wit-tab-content[data-content="${tabTarget}"]`);
        if (targetContent) {
          targetContent.classList.add("wit-tab-content_active");
        } 
      });
    });
  });
});

new Swiper('.wit-destination-banner-swiper', {
  slidesPerView: 1,
  spaceBetween: 0,
  speed: 1000,
  autoplay: {
    delay: 7000,
    disableOnInteraction: true,
  },
})