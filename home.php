<?php get_component('/header.php');

$featuredPosts = new WP_Query(array(
	'post_type' => 'post',
	'posts_per_page' => 8,
	'meta_query' => array(
		array(
			'key' => 'Featured',
			'value' => TRUE,
		),
	),
));

$allPosts = new WP_Query(array(
	'post_type' => 'post',
	'posts_per_page' => 12,
	'paged' => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1,
));

?>
<main class="flex flex-col">
  <section class="pt-6 pb-12 lg:pt-12 lg:pb-6">
    <div class="container text-center">
      <h1 class="headline">Blog / Planning Tips</h1>
    </div>
  </section>
	<?php if( !is_paged() ) : ?>
		<?php if ($featuredPosts->have_posts()) : ?>
		<section class="wit-section-featured_venue pt-0 pb-12">
			<div class="container">
				<div class="wit-section-inner">
					<div class="wit-section-inner-header">
						<h2>Recommend Blog / Planning Tips</h2>
						<div class="wit-section-inner-header_right">
							<div class="wit-swiper-button">
								<div class="swiper-button-prev wit-swiper-button-prev"></div>
								<div class="swiper-button-next wit-swiper-button-next"></div>
							</div>
						</div>
					</div>

					<div class="swiper wit-swiper" data-slides="1.13" data-space="24" data-breakpoints='{"450":{"slidesPerView":1.5},"767":{"slidesPerView":2.5},"992":{"slidesPerView":3.2},"1200":{"slidesPerView":3.65,"spaceBetween":16}}'>
						<div class="swiper-wrapper">
							<?php while ($featuredPosts->have_posts()) : $featuredPosts->the_post(); ?>
							<div class="swiper-slide">
								<?php get_component('/card-post.php'); ?>
							</div>
							<?php endwhile; wp_reset_postdata(); ?>
						</div>
						<div class="swiper-pagination wit-swiper-card-pagination"></div>
					</div>
				</div>
			</div>
		</section>
		<?php endif; ?>
	<?php endif; ?>
	
	<?php if($allPosts->have_posts()) : ?>
	<section class="wit-section-all_venues !pb-6 lg:!pb-8">
		<div class="container">
			<div class="wit-section-inner">
				<div class="wit-section-inner-header">
					<h1 class="title">All Blog / Planning Tips <small class="text-xs">Page <?php echo ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; ?> of <?php echo $allPosts->max_num_pages; ?></small></h1>
					<div class="wit-section-inner-header_right items-end">
						<p class="m-0 text-[12px] text-[#595959] ">(<?php echo $allPosts->found_posts; ?>)</p>
					</div>
				</div>

				<div class="wit-grid-card mb-[16px]">
					<div class="wit-grid-card_wrapper sm:grid-cols-2 md:grid-cols-3">
						<?php
						if ( $allPosts->have_posts() ) :
							while ( $allPosts->have_posts() ) : $allPosts->the_post();
								get_component('/card-post-2.php');
							endwhile;
							wp_reset_postdata();
						else :
							echo '<p>No venues found.</p>';
						endif;
						?>
					</div>
				</div>

				<div class="flex justify-center">
          <?php custom_pagination( $allPosts ); ?>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>
</main>
<?php get_component('/footer.php'); ?>