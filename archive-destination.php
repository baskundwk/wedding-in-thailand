<?php get_component('/header.php');
$allDestinationQuery = new WP_Query(array(
  'post_type' => 'destination',
  'posts_per_page' => -1,
));
?>
<main class="flex flex-col gap-6 pt-6 pb-[72px] lg:py-[48px] lg:gap-[72px]">
	<section class="pt-6 lg:pt-8">
    <div class="container">
      <h1 class="text-center headline mb-4">
        Discover Your Dream<br/>
        <span class="text-blue">Wedding Destination</span> in Thailand
      </h1>
      <div class="swiper wit-destination-banner-swiper">
        <div class="swiper-wrapper">
          <?php
          $bannerDestinations = new WP_Query(array(
            'post_type' => 'destination',
            'posts_per_page' => -1,
            'meta_query' => array(
              array(
                'key' => 'FeaturedIn',
                'value' => 'Destination Archive',
                'compare' => 'LIKE',
              ),
            ),
          ));
          if ( $bannerDestinations->have_posts() ) :
            while ( $bannerDestinations->have_posts() ) : $bannerDestinations->the_post(); ?>
              <div class="swiper-slide">
                <a href="<?php the_permalink();?>">
                  <div class="banner-text">
                    <h2 class="title"><?php the_title(); ?></h2>
                    <?php if(get_the_excerpt()) { ?>
                      <p class="desc"><?php echo get_the_excerpt(); ?></p>
                    <?php } ?>
                  </div>
                  <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>" alt="<?php the_title(); ?>" class="w-full h-auto object-cover">
                </a>
              </div>
            <?php endwhile;
            wp_reset_postdata();
          endif;
          ?>
        </div>
      </div>
    </div>
  </section>
	<section>
    <div class="container">
      <h2 class="mb-4 headline">Recommended Destinations</h2>
      <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
        <?php
        $allDestinations = new WP_Query(array(
          'post_type' => 'destination',
          'posts_per_page' => -1,
          'meta_query' => array(
            array(
              'key' => 'RecommendedIn',
              'value' => 'Destination Archive',
              'compare' => 'LIKE',
            ),
          ),
        ));
        if ( $allDestinations->have_posts() ) :
          while ( $allDestinations->have_posts() ) : $allDestinations->the_post(); ?>
            <?php get_component('/card-destination-1.php'); ?>
          <?php endwhile;
          wp_reset_postdata();
        endif;
        ?>
    </div>
  </section>
  <?php $perks = [];
  if( $allDestinationQuery->have_posts() ) :
  while ( $allDestinationQuery->have_posts() ) : $allDestinationQuery->the_post();
    foreach(get_field('Perk') as $perk) {
      $perks[] = get_term($perk)->name;
    }
  endwhile; 
  $unique_perks = array_unique($perks, SORT_REGULAR);
  ?>
	<section class="pb-6 lg:pb-8">
    <div class="container">
      <h2 class="headline mb-4">Destinations</h2>
      <div class="wit-tabs">
        <div class="flex gap-2 flex-wrap mb-4">
          <button class="wit-tab wit-chip active" data-target="all">All</button>
          <?php
          $perkIndex = 0;
          foreach($unique_perks as $perk) {?>
            <button class="wit-tab wit-chip" data-target="<?php echo $perk; ?>"><?php echo $perk; ?></button>
          <?php } ?>
        </div>
        <div class="wit-tab-content wit-tab-content_active" data-content="all">
          <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-2 wit-destination-list">
          <?php
            // Print out main query
            while ( $allDestinationQuery->have_posts() ) : $allDestinationQuery->the_post();
              get_component('/card-destination-2.php');
            endwhile;
            wp_reset_postdata();
            ?>
          </div>
        </div>
        <?php foreach($unique_perks as $perk) {?>
          <div class="wit-tab-content" data-content="<?php echo $perk; ?>">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-2 wit-destination-list">
            <?php
              // Print out filtered query
              while ( $allDestinationQuery->have_posts() ) : $allDestinationQuery->the_post();
                $destination_perks = [];
                foreach(get_field('Perk') as $destination_perk) {
                  $destination_perks[] = get_term($destination_perk)->name;
                }
                if(in_array($perk, $destination_perks)) {
                  get_component('/card-destination-2.php');
                }
              endwhile;
              wp_reset_postdata();
              ?>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>
  <?php wp_reset_postdata(); endif; ?>
</main>
<?php get_component('/footer.php'); ?>