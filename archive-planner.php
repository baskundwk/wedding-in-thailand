<?php get_component('/header.php');

$featuredDestinations = new WP_Query(array(
	'post_type' => 'destination',
	'posts_per_page' => -1,
	'meta_query' => array(
		array(
			'key' => 'FeaturedIn',
			'value' => 'Planner Archive',
			'compare' => 'LIKE',
		),
	),
));

$recommendedDestinations = new WP_Query(array(
	'post_type' => 'destination',
	'posts_per_page' => -1,
	'meta_query' => array(
		array(
			'key' => 'RecommendedIn',
			'value' => 'Planner Archive',
			'compare' => 'LIKE',
		),
	),
));

$featuredPlanners = new WP_Query(array(
	'post_type' => 'planner',
	'posts_per_page' => 12,
	'meta_query' => array(
		array(
			'key' => 'Featured',
			'value' => TRUE,
		),
	),
));

$allPlanners = new WP_Query(array(
	'post_type' => 'planner',
	'posts_per_page' => 12,
	'paged' => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1,
));
?>
<main class="flex flex-col gap-6 lg:gap-[72px]">
	<?php if( !is_paged() ) : ?>
		<?php if ($featuredPlanners->have_posts()) : ?>
		<section class="wit-section-featured_venue pt-6 lg:pt-8">
			<div class="container">
				<div class="wit-section-inner">
					<div class="wit-section-inner-header">
						<h2>Featured Planner</h2>
						<div class="wit-section-inner-header_right">
							<div class="wit-swiper-button">
								<div class="swiper-button-prev wit-swiper-button-prev"></div>
								<div class="swiper-button-next wit-swiper-button-next"></div>
							</div>
						</div>
					</div>

					<div class="swiper wit-swiper" data-slides="1.13" data-space="24" data-breakpoints='{"450":{"slidesPerView":1.5},"767":{"slidesPerView":2.5},"992":{"slidesPerView":3.2},"1200":{"slidesPerView":3.65,"spaceBetween":16}}'>
						<div class="swiper-wrapper">
							<?php while ($featuredPlanners->have_posts()) : $featuredPlanners->the_post(); ?>
							<div class="swiper-slide">
								<?php get_component('/card-venue-1.php'); ?>
							</div>
							<?php endwhile; wp_reset_postdata(); ?>
						</div>
						<div class="swiper-pagination wit-swiper-card-pagination"></div>
					</div>
				</div>
			</div>
		</section>
		<?php endif; ?>

		<?php if ($recommendedDestinations->have_posts()) : ?>
			<section class="wit-section-recommend ">
				<div class="container">
					<div class="wit-section-inner">
						<div class="wit-section-inner-header">
							<h2>Recommended Destinations</h2>
							<div class="wit-section-inner-header_right">
								<a href="<?php echo esc_url( home_url( '/destination' ) ); ?>" class="wit-link ">View All
									<img src="<?php echo get_stylesheet_directory_uri(  ) ?>/assets/images/icons/ic-arrow-left.svg" alt="" class="wit-link_icon">
								</a>
							</div>
						</div>
						<div class="wit-location-wrapper">
							<div class="wit-location-thailand">
								<img src="<?php echo get_stylesheet_directory_uri(  ) ?>/assets/images/pages/archive-venue/recommend-thailand.png" alt="">
							</div>
							<div class="wit-location-group">
								<?php while ($recommendedDestinations->have_posts()) : $recommendedDestinations->the_post(); ?>
									<?php get_component('/card-destination-1.php'); ?>
								<?php endwhile;
								wp_reset_postdata(); ?>
							</div>
						</div>
					</div>
				</div>
			</section>
		<?php endif; ?>


		<?php if($featuredDestinations->have_posts()) : ?>
			<?php while($featuredDestinations->have_posts()) : $featuredDestinations->the_post(); 
				$destination_venues = new WP_Query(array(
					'post_type' => 'planner',
					'posts_per_page' => 6,
					'meta_query' => array(
						array(
							'key' => 'Destination',
							'value' => get_the_ID(),
							'compare' => 'LIKE',
						),
					),
				));

				if ( ! $destination_venues->have_posts() ) {
					continue; // Skip to the next destination if no venues found
				}
				?>
				<?php
					$destination_name = get_the_title();
					$destination_slug = get_post_field( 'post_name', get_the_ID() );
				?>
				<section class="wit-section-destination_venues ">
					<div class="container">
						<div class="wit-section-inner">
							<div class="wit-section-inner-header">
								<h2>Planners in <?php echo esc_html( $destination_name ); ?></h2>
								<div class="wit-section-inner-header_right">
									<a href="<?php echo esc_url( home_url( '/destination/' . $destination_slug ) ); ?>" class="wit-link ">View All
										<img src="<?php echo get_stylesheet_directory_uri(  ) ?>/assets/images/icons/ic-arrow-left.svg" alt="" class="wit-link_icon">
									</a>
								</div>
							</div>

							<div class="wit-grid-card mb-[16px]">
								<div class="wit-grid-card_wrapper sm:grid-cols-2 md:grid-cols-3">
									<?php
									if ( $destination_venues->have_posts() ) :
										while ( $destination_venues->have_posts() ) : $destination_venues->the_post();
											get_component('/card-venue-2.php');
										endwhile;
										wp_reset_postdata();
									else :
										echo '<p>No venues found for this destination.</p>';
									endif;
									?>
								</div>
							</div>
							<div class="flex justify-center">
								<a href="<?php echo esc_url( home_url( '/destination/' . $destination_slug ) ); ?>"
									class="w-full max-w-[343px] flex justify-center items-center bg-[#F0F0F0] py-[13px] text-sm md:text-base font-medium text-[#060606] rounded-[8px]">View
									more</a>
							</div>
						</div>
					</div>
				</section>
			<?php endwhile; wp_reset_postdata(); ?>
		<?php endif; ?>
	<?php endif; ?>
	
	<?php if($allPlanners->have_posts()) : ?>
	<section class="wit-section-all_venues !pb-6 lg:!pb-8">
		<div class="container">
			<div class="wit-section-inner">
				<div class="wit-section-inner-header">
					<h1 class="title">All venues</h1>
					<div class="wit-section-inner-header_right items-end">
						<p class="m-0 text-[12px] text-[#595959] ">(<?php echo $allPlanners->found_posts; ?>)</p>
					</div>

				</div>

				<div class="wit-grid-card mb-[16px]">
					<div class="wit-grid-card_wrapper sm:grid-cols-2 md:grid-cols-3">
						<?php
						if ( $allPlanners->have_posts() ) :
							while ( $allPlanners->have_posts() ) : $allPlanners->the_post();
								get_component('/card-venue-2.php');
							endwhile;
							wp_reset_postdata();
						else :
							echo '<p>No venues found.</p>';
						endif;
						?>
					</div>
				</div>

				<div class="flex justify-center">
          <?php custom_pagination( $allPlanners ); ?>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>
</main>
<?php get_component('/footer.php'); ?>