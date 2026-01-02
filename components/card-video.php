<a href="<?php the_permalink(  ) ?>" class="wit-vdo-card" target="_blank">
  <div class="wit-vdo-card_img">
    <?php if( get_the_post_thumbnail( )) : ?>
      <?php the_post_thumbnail( 'medium_large' ); ?>
    <?php endif; ?>
  </div>
  <div class="wit-vdo-card_icon">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-play.svg" alt="">
  </div>
  <h3 class="wit-vdo-card_name">
    <?php the_title(); ?>
  </h3>
</a>