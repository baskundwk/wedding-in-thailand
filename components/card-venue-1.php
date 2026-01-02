<div class="wit-card">
    <a href="<?php the_permalink( )?>" class="swiper wit-card-img_swiper wit-swiper-card_img">
        <?php if( get_field('Character')) : ?>
            <div class="wit-tag wit-tag_primary"><?php echo get_term( get_field('Character')[0] )->name ; ?></div>
        <?php endif; ?>
        <div class="swiper-wrapper">
            <?php // get image from post thumbnail and first 2 gallery field images ?>
            <div class="swiper-slide wit-card-img_wrapper">
                <?php 
                if( has_post_thumbnail() ) {
                    the_post_thumbnail( 'large' );
                }
                ?>
            </div>
            <?php if( get_field('Album') ) :
                $albums = get_field('Album');
                $allGalleryImages = array();
                foreach( $albums as $album ) {
                    if( isset($album['AlbumImage']) ) {
                        foreach( $album['AlbumImage'] as $image ) {
                            $allGalleryImages[] = $image;
                        }
                    }
                }
                for( $i = 0; $i < 2; $i++ ) {
                    if( isset($allGalleryImages[$i]) ) : ?>
                        <div class="swiper-slide wit-card-img_wrapper">
                            <?php echo wp_get_attachment_image( $allGalleryImages[$i]['ID'], 'full' ); ?>
                        </div>
                    <?php endif;
                }

                endif;
            ?>
        </div>
        <div class="swiper-pagination"></div>
    </a>

    <div class="wit-card-content">
        <div class="wit-card-details">
            <h3>
                <a href="<?php the_permalink(); ?>" class="wit-card-title">
                    <?php the_title(); ?>
                </a>
            </h3>

            <?php if( get_post_meta( get_the_ID(), 'Destination', true ) ) : ?>
                <a href="<?php echo get_permalink(get_post_meta( get_the_ID(), 'Destination', true )); ?>" class="wit-link"><?php echo get_the_title(get_post_meta( get_the_ID(), 'Destination', true )); ?></a>
            <?php endif; ?>

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
                <p>Guest:
                    <b><?php echo number_format(get_post_meta( get_the_ID(), 'Guest', true )); ?></b>
                </p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>