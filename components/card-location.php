<a href="<?php the_permalink(); ?>" class="wit-location-group_item">
  <div class="wit-location-group_item_img">
    <?php if( has_post_thumbnail() ) {
        the_post_thumbnail( 'medium' );
    } ?>
  </div>
  <p class="text-base font-medium"><?php the_title() ?></p>
</a>