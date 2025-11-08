<?php get_component( '/header.php' ); ?>
<main class="flex flex-col gap-6 pt-6 pb-[72px] lg:py-[48px] lg:gap-[72px]">
    <section class="wit-sc_featured_venue ">
        <div class="container">
            <div class="wit-sc_inner">
                <div class="wit-sc_inner-header">

                    <h2>Featured Venue</h2>
                    <div class="wit-sc_inner-header_right">

                        <div class="wit-swiper-button">

                            <div class="swiper-button-prev wit-swiper-button-prev"></div>
                            <div class="swiper-button-next wit-swiper-button-next"></div>
                        </div>
                    </div>


                </div>

                <div class="swiper wit-swiper-card  ">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <?php get_component( '/card-venue-1.php' ); ?>
                        </div>
                        <div class="swiper-slide">
                            <?php get_component( '/card-venue-1.php' ); ?>
                        </div>
                        <div class="swiper-slide">
                            <?php get_component( '/card-venue-1.php' ); ?>
                        </div>
                        <div class="swiper-slide">
                            <?php get_component( '/card-venue-1.php' ); ?>
                        </div>
                        <div class="swiper-slide">
                            <?php get_component( '/card-venue-1.php' ); ?>
                        </div>
                    </div>
                    <div class="swiper-pagination wit-swiper-card-pagination"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="wit-sc_recommend ">
        <div class="container">
            <div class="wit-sc_inner">
                <div class="wit-sc_inner-header">

                    <h2>Recommend Destinations</h2>
                    <div class="wit-sc_inner-header_right">



                        <a href="http://" class="wit-link ">View All

                            <img src="./assets/images/icons/ic-arrow-left.svg" alt="" class="wit-link_icon">
                        </a>
                    </div>
                </div>
                <div class="wit-location-wrapper">
                    <div class="wit-location-thailand">
                        <img src="./assets/images/pages/archive-venue/recommend-thailand.png" alt="">
                    </div>
                    <div class="wit-location-group">
                        <?php get_component( '/card-location.php' ); ?>
                        <?php get_component( '/card-location.php' ); ?>
                        <?php get_component( '/card-location.php' ); ?>
                        <?php get_component( '/card-location.php' ); ?>
                        <?php get_component( '/card-location.php' ); ?>
                        <?php get_component( '/card-location.php' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="wit-sc_venue_bangkok ">
        <div class="container">
            <div class="wit-sc_inner">
                <div class="wit-sc_inner-header">

                    <h2>Venues in Bangkok</h2>
                    <div class="wit-sc_inner-header_right">

                        <div class="wit-swiper-button">

                            <div class="swiper-button-prev wit-swiper-button-prev"></div>
                            <div class="swiper-button-next wit-swiper-button-next"></div>
                        </div>

                        <a href="http://" class="wit-link ">View All

                            <img src="./assets/images/icons/ic-arrow-left.svg" alt="" class="wit-link_icon">
                        </a>
                    </div>

                </div>

                <div class="swiper wit-swiper-card wit-swiper-card_col4 ">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <?php get_component( '/card-venue-2.php' ); ?>
                        </div>
                        <div class="swiper-slide">
                            <?php get_component( '/card-venue-2.php' ); ?>
                        </div>
                        <div class="swiper-slide">
                            <?php get_component( '/card-venue-2.php' ); ?>
                        </div>
                        <div class="swiper-slide">
                            <?php get_component( '/card-venue-2.php' ); ?>
                        </div>
                        <div class="swiper-slide">
                            <?php get_component( '/card-venue-2.php' ); ?>
                        </div>
                        <div class="swiper-slide">
                            <?php get_component( '/card-venue-2.php' ); ?>
                        </div>
                    </div>
                    <div class="swiper-pagination wit-swiper-card-pagination"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="wit-sc_all_venues ">
        <div class="container">
            <div class="wit-sc_inner">
                <div class="wit-sc_inner-header">

                    <h2>All venues</h2>
                    <div class="wit-sc_inner-header_right items-end">
                        <p class="m-0 text-[12px] text-[#595959] ">(999)</p>
                    </div>

                </div>

                <div class="wit-grid-card mb-[16px]">
                    <div class="wit-grid-card_wrapper sm:grid-cols-2 md:grid-cols-3">
                        <?php get_component( '/card-venue-2.php' ); ?>
                        <?php get_component( '/card-venue-2.php' ); ?>
                        <?php get_component( '/card-venue-2.php' ); ?>
                        <?php get_component( '/card-venue-2.php' ); ?>
                        <?php get_component( '/card-venue-2.php' ); ?>
                        <?php get_component( '/card-venue-2.php' ); ?>
                        <?php get_component( '/card-venue-2.php' ); ?>
                        <?php get_component( '/card-venue-2.php' ); ?>
                        <?php get_component( '/card-venue-2.php' ); ?>
                        <?php get_component( '/card-venue-2.php' ); ?>
                        <?php get_component( '/card-venue-2.php' ); ?>
                        <?php get_component( '/card-venue-2.php' ); ?>
                    </div>
                </div>

                <div class="flex justify-center">

                    <a href="http://"
                        class="w-full max-w-[343px] flex justify-center items-center bg-[#F0F0F0] py-[13px] text-sm md:text-base font-medium text-[#060606] rounded-[8px]">View
                        more</a>
                </div>






            </div>
        </div>
    </section>
</main>
<?php get_component( '/footer.php' ); ?>