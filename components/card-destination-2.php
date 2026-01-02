<a href="<?php the_permalink(); ?>" class="wit-card-destination-2">
  <div class="wit-card-destination-img">
    <?php if( has_post_thumbnail() ) {
        the_post_thumbnail( 'medium' );
    } ?>
  </div>
  <h3><?php the_title() ?></h3>
</a>