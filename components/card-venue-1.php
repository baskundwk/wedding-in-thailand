<div class="wit-card">
    <div class="swiper wit-card-img_swiper wit-swiper-card_img">
        <div class="wit-tag wit-tag_primary">USP Tag</div>
        <div class="swiper-wrapper">
            <?php // get image from post thumbnail and first 2 gallery field images ?>
            <div class="swiper-slide wit-card-img_wrapper">
                <?php 
                if( has_post_thumbnail() ) {
                    the_post_thumbnail( 'large' );
                }
                ?>
            </div>
            <?php if( get_field('Gallery') ) :
                $gallery = get_field('Gallery');
                for( $i = 0; $i < 2; $i++ ) {
                    if( isset($gallery[$i]) ) : ?>
                        <div class="swiper-slide wit-card-img_wrapper">
                            <?php echo wp_get_attachment_image( $gallery[$i]['ID'], 'full' ); ?>
                        </div>
                    <?php endif;
                }

                endif;
            ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>

    <div class="wit-card-content">
        <div class="wit-card-details">
            <h3>
                <a href="#" class="wit-card-title">
                    <?php the_title(); ?>
                </a>
            </h3>

            <a href="#" class="wit-link"><?php echo get_post_meta( get_the_ID(), 'location', true ); ?></a>
            <?php if( get_field('Language') ) : ?>
                <?php $languages = get_field('Language');?>
                <p><?php echo implode("/", array_map(function($lang) {
                        return get_field('Code', 'language_' . $lang);
                    }, $languages)); ?></p>
            <?php endif; ?>
            <?php if( get_post_meta( get_the_ID(), 'PriceStart', true ) ) : ?>
            <div class="wit-card-price">
                <p>Starting:
                    <b><?php echo number_format(get_post_meta( get_the_ID(), 'PriceStart', true )); ?></b>
                </p>
            </div>
            <?php endif; ?>
            <?php if( get_post_meta( get_the_ID(), 'Guest', true ) ) : ?>
            <div class="wit-card-guest_capacity">
                <p>Guest:</p>
                <b><?php echo number_format(get_post_meta( get_the_ID(), 'Guest', true )); ?></b>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>