<a href="<?php the_permalink(  ) ?>">
  <div class="wit-card-date-2">
    <div class="wit-card-img_wrapper">
      <?php 
        if( has_post_thumbnail() ) {
          the_post_thumbnail( 'medium_large' );
        }
      ?>
    </div>
  
    <div class="wit-card-content">
      <h3 class="wit-card-title"><?php the_title(); ?></h3>
      <p class="wit-card-desc line-clamp-2"><?php echo get_the_excerpt(); ?></p>
  
      <div
        class="flex items-center gap-1 text-[#595959] text-[10px] font-normal pt-[13px]">
        <p><?php echo wp_estimated_reading_time(); ?> min read</p>
        <p>|</p>
        <p><?php the_time('F j, Y'); ?></p>
      </div>
  
    </div>
  </div>
</a>