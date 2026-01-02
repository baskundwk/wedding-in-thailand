<a href="<?php the_permalink(); ?>" class="wit-card-destination-1">
  <div class="wit-card-destination-img">
    <?php if( has_post_thumbnail() ) {
        the_post_thumbnail( 'medium' );
    } ?>
  </div>
  <p class="text-base font-medium"><?php the_title() ?></p>
</a>