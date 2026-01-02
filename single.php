<?php get_component('/header.php'); ?>
<main>
  <section class="py-6 lg:py-12">
    <div class="container"> <!-- !max-w-[800px] mx-auto -->
      <div class="mb-8">
        <a href="<?php echo get_post_type_archive_link('planner'); ?>" class="wit-link flex items-center gap-1 mb-2 text-xs">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-arrow-left.svg" alt="" class="w-4 h-4"> View other planners
        </a>
        <h1 class="headline"><?php the_title(); ?></h1>
        <div
          class="flex items-center gap-1 text-[#595959] text-[10px] font-normal mt-2">
          <span><?php echo wp_estimated_reading_time(); ?> min read</span>
          <span>|</span>
          <span><?php the_time('F j, Y'); ?></span>
        </div>
      </div>

      <div class="wit-single-content max-w-none mb-8">
        <div class="mb-4"><?php the_content(); ?></div>
        <div class="tags">
          <h2 class="mb-1">Tags</h2>
          <div class="flex gap-1 flex-wrap">
            <?php
              $post_tags = get_the_tags();
              if ( $post_tags ) {
                foreach( $post_tags as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                  echo '<a href="' . esc_url( $tag_link ) . '" class="wit-tag">' . esc_html( $tag->name ) . '</a>';
                }
              }
            ?>
          </div>
        </div>
      </div>
    </div>
    <?php
      $related_posts_field = get_field('RelatedPost');
      if( $related_posts_field ) {
        $related_posts = new WP_Query( array(
          'post_type' => 'post',
          'posts_per_page' => 8,
          'post__in' => $related_posts_field,
        ) );
      } else {
        $related_posts = new WP_Query( array(
          'post_type' => 'post',
          'posts_per_page' => 8,
        ) );
      }

      if( $related_posts->have_posts() ) :
    ?>
    <div class="container mt-6 lg:mt-8">
      <h2 class="headline mb-4">Related Blog / Planning Tips</h2>
      <div class="swiper wit-swiper" data-slides="1.13" data-space="24" data-breakpoints='{"450":{"slidesPerView":1.5},"767":{"slidesPerView":2.5},"992":{"slidesPerView":3.2},"1200":{"slidesPerView":4,"spaceBetween":16}}'>
        <div class="swiper-wrapper">
          <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
          <div class="swiper-slide">
            <?php get_component('/card-post.php'); ?>
          </div>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <div class="swiper-pagination wit-swiper-card-pagination"></div>
      </div>
    </div>
    <?php endif; ?>
  </section>
</main>
<?php get_component('/footer.php'); ?>