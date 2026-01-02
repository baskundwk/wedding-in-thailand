<?php get_component('/header.php'); ?>
<?php $fields = get_fields();
$allGalleryImages = array();?>
<div class="debug floating-debugger">
	<pre class="floating-debugger-content"><?php print_r($fields); ?></pre>
	<button class="floating-debugger-toggle">
		&#9733;
	</button>
</div>
<main class="flex flex-col gap-6">
	<section class="wit-section-header_venue pt-6 lg:pt-8">
		<div class="container">
			<div class="wit-section-inner flex flex-col gap-4">
				<a href="<?php echo get_post_type_archive_link('destination'); ?>" class="wit-link flex items-center gap-1">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-arrow-left.svg" alt="" class="w-4 h-4"> View other destinations
				</a>
				<?php
				if (!empty($fields['Banner'])) :
					$banners = $fields['Banner'];
				?>
					<div class="wit-section-header_venue_img_wrapper">

						<?php $bannerIndex = 1;
						foreach ($banners as $banner) :
							if ($bannerIndex <= 3) : ?>
								<div class="wit-section-header_venue_img_wrapper_img wit-gallery-modal-single">
									<img src="<?php echo esc_url($banner['url']); ?>" alt="">
									<?php if (count($banners) > 3 && $bannerIndex === 3) : ?>
										<div class="wit-section-header_venue_img_wrapper_img_overlay">
											+<?php echo count($banners) - 3; ?>
										</div>
									<?php endif; ?>
								</div>
						<?php endif;
							$bannerIndex++;
						endforeach; ?>

						<!-- Mobile Swiper Layout -->
						<div class="wit-section-header_venue_swiper swiper">
							<div class="swiper-wrapper">
								<?php foreach ($banners as $banner) : ?>
									<div class="swiper-slide wit-gallery-modal-single">
										<img src="<?php echo esc_url($banner['url']); ?>" alt="">
									</div>
								<?php endforeach; ?>
							</div>
							<!-- Navigation -->
							<div class="swiper-button-prev wit-swiper-button"></div>
							<div class="swiper-button-next wit-swiper-button"></div>
							<!-- Pagination -->
							<div class="swiper-pagination"></div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<section class="wit-section-venue_content pb-6 lg:pb-8">
		<div class="container">
			<div class="wit-section-venue_content_inner !grid-cols-1">
				<div class="wit-section-venue_content_inner_left !max-w-full">
					<section class="wit-section-venue_description">
						<div class="wit-section-inner flex flex-col gap-1">
							<div class="wit-section-inner-header">
								<h2><?php the_title(); ?></h2>
							</div>

							<?php if (!empty($fields['Perk'])) : ?>
								<div class="wit-tag_wrapper">
									<?php foreach ($fields['Perk'] as $perk) { ?>
										<a href="<?php echo get_term_link($perk) ?>" class="wit-tag"><?php echo get_term($perk)->name; ?></a>
									<?php } ?>
								</div>
							<?php endif; ?>

							<?php if (get_the_content()) : ?>
								<div class="wit-desc"><?php the_content(); ?></div>

								<div class="wit-link wit-link_view_all flex items-center gap-1">
									View All

									<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-arrow-down-primary.svg" alt="">
								</div>
							<?php endif; ?>

						</div>
					</section>

					<?php if (!empty($fields['Tagline'])) : ?>
						<section class="wit-section-venue_amenities">
							<div class="wit-section-inner">
								<?php foreach ($fields['Tagline'] as $tagline) { ?>
									<div class="wit-amenities_card">
										<p><?php echo get_term($tagline)->name; ?></p>
									</div>
								<?php } ?>

							</div>
						</section>
					<?php endif; ?>
          
          <?php 
          $venuesInDestination = new WP_Query( array(
            'post_type' => 'venue',
            'posts_per_page' => 16,
            'meta_query' => array(
							array(
								'key'     => 'Destination',
								'value'   => '"' . get_the_ID() . '"',
								'compare' => 'LIKE',
							),
            ),
          ) );
          if ( $venuesInDestination->have_posts() ) : ?>
					<section class="wit-section-featured_venue">
						<div class="wit-section-inner">
							<div class="wit-section-inner-header">
								<h2>Venues in <?php echo get_the_title(); ?></h2>
								<div class="wit-section-inner-header_right">
									<div class="wit-swiper-button">
										<div class="swiper-button-prev wit-swiper-button-prev"></div>
										<div class="swiper-button-next wit-swiper-button-next"></div>
									</div>
								</div>
							</div>

							<div class="swiper wit-swiper" data-slides="1.2" data-space="16" data-breakpoints='{"450":{"slidesPerView":3.2},"768":{"slidesPerView":3.8}, "1024":{"slidesPerView":4.5}}'>
								<div class="swiper-wrapper">
                  <?php while($venuesInDestination->have_posts()) : $venuesInDestination->the_post(); ?>
									<div class="swiper-slide">
										<?php get_component('/card-venue-1.php'); ?>
									</div>
                  <?php endwhile; ?>
								</div>
								<div class="swiper-pagination wit-swiper-card-pagination"></div>
							</div>
						</div>
					</section>
          <?php wp_reset_postdata();
          endif; ?>

					<?php $post_query = new WP_Query( array(
						'post_type' => 'post',
						'posts_per_page' => 16,
						'meta_query' => array(
							array(
								'key'     => 'RelatedDestination',
								'value'   => '"' . get_the_ID() . '"',
								'compare' => 'LIKE',
							),
						),
					) );
					if ( $post_query->have_posts() ) : ?> 
					<section class="wit-section-wedding_stories">
						<div class="wit-section-inner">
							<div class="wit-section-inner-header">
								<h2>Recommended Blog / Planning Tips</h2>
								<div class="wit-section-inner-header_right">
									<div class="wit-swiper-button">
										<div class="swiper-button-prev wit-swiper-button-prev"></div>
										<div class="swiper-button-next wit-swiper-button-next"></div>
									</div>
								</div>
							</div>

							<div class="swiper wit-swiper" data-slides="1.8" data-space="16" data-breakpoints='{"450":{"slidesPerView":2.2},"768":{"slidesPerView":3}, "1024":{"slidesPerView":4}}'>
								<div class="swiper-wrapper">
									<?php while($post_query->have_posts()) : $post_query->the_post(); ?>
									<div class="swiper-slide">
										<?php get_component('/card-post.php'); ?>
									</div>
									<?php endwhile; ?>
								</div>
								<div class="swiper-pagination wit-swiper-card-pagination"></div>
							</div>
						</div>

					</section>
					<?php wp_reset_postdata();
					endif; ?>

          <?php $relatedDestinations = get_field('RelatedDestination');
          if(!empty($relatedDestinations)) {
            $relatedDestinationIds = array_map(function($post) {
              return is_object($post) ? $post->ID : $post;
            }, $relatedDestinations);
          } else {
            $relatedDestinationIds = array();
          }
          $relatedDestinationsQuery = new WP_Query( array(
            'post_type' => 'destination',
            'post__in' => $relatedDestinationIds,
            'posts_per_page' => -1,
            'orderby' => 'post__in',
          ) );
          if($relatedDestinationsQuery->have_posts()) : ?>
          <section class="wit-section-related_destinations">
            <div class="container">
              <div class="wit-section-inner">
                <div class="wit-section-inner-header">
                  <h2 class="headline">Related Destinations</h2>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                  <?php while($relatedDestinationsQuery->have_posts()) : $relatedDestinationsQuery->the_post();
                  ?>
                  <div>
                    <?php get_component('/card-destination-2.php'); ?>
                  </div>
                  <?php endwhile; 
                  wp_reset_postdata(); ?>
                </div>
              </div>
            </div>
          </section>
          <?php endif; ?>
				</div>
			</div>
		</div>


	</section>
</main>

<!-- Gallery Modal -->
<?php if (!empty($fields['Album']) && !empty($allGalleryImages)) : ?>
<div class="wit-gallery-modal" id="wit-gallery-modal">
	<div class="wit-gallery-modal-overlay"></div>
	<div class="wit-gallery-modal-content">
		<div class="wit-gallery-modal-header">
			<h3>Gallery</h3>
			<button class="wit-gallery-modal-close" id="wit-gallery-modal-close" title="Close">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-Close_MD.svg" alt="Close">
			</button>
		</div>

		<div class="wit-gallery-modal-tabs">
			<button class="wit-gallery-modal-tab active" data-category="all">All</button>
			<?php foreach ($fields['Album'] as $album) : ?>
				<button class="wit-gallery-modal-tab" data-category="<?php echo $album['AlbumTitle']; ?>"><?php echo $album['AlbumTitle']; ?></button>
			<?php endforeach; ?>
		</div>

		<div class="wit-gallery-modal-body">
			<div class="wit-gallery-modal-grid" id="wit-gallery-modal-grid">
				<?php foreach ($fields['Album'] as $album) : ?>
					<?php foreach ($album['AlbumImage'] as $image) : ?>
						<div class="wit-gallery-modal-item wit-gallery-modal-single" data-category="<?php echo $album['AlbumTitle']; ?>">
							<img src="<?php echo wp_get_attachment_url($image['ID']); ?>" alt="">
						</div>
					<?php endforeach; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php if ( isset($allGalleryImages) &&  !empty($allGalleryImages)) : ?>
<div class="wit-gallery-single-modal" id="wit-gallery-single-modal">
	<div class="wit-gallery-modal-overlay"></div>
	<div class="wit-gallery-modal-content">
		<div class="wit-gallery-modal-header">
			<button class="wit-gallery-modal-close" id="wit-gallery-single-modal-close" title="Close">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-Close_MD_white.svg" alt="Close">
			</button>
		</div>

		<div class="wit-gallery-modal-body">
			<div class="wit-gallery-modal-single-swiper swiper">
				<div class="swiper-wrapper">
					<?php $galleryImageIndex = 0;
					foreach($allGalleryImages as $image) : 
					$galleryImageIndex++?>
					<div class="swiper-slide">
						<div class="wit-gallery-modal-single-img_wrapper">
							<img src="<?php echo wp_get_attachment_url($image['ID']); ?>" alt="Gallery Image <?php echo $galleryImageIndex; ?>">
						</div>
					</div>
					<?php endforeach; ?>
				</div>
				<div class="wit-gallery-total_img">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-Image_01.svg" alt="">
					<span id="wit-gallery-total_number"><?php echo count($allGalleryImages); ?></span>
				</div>
				<div class="wit-swiper-button swiper-button-prev">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-arrow-left.svg" alt="Arrow Left">
				</div>
				<div class="wit-swiper-button swiper-button-next">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-arrow-left.svg" alt="Arrow Right">
				</div>
				<div class="wit-swiper-pagination swiper-pagination"></div>

			</div>
			<div class="wit-swiper-gallery-thumbnails">
				<div class="swiper wit-swiper-gallery-thumbnails-swiper">
					<div class="swiper-wrapper">
						<?php $galleryThumbnailIndex = 0;
							foreach($allGalleryImages as $image) :
							$galleryThumbnailIndex++;
						?>
						<div class="swiper-slide">
							<img src="<?php echo wp_get_attachment_url($image['ID']); ?>" alt="Thumbnail <?php echo $galleryThumbnailIndex; ?>">
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
<?php endif; ?>

<!-- Vdo Modal -->
<?php /* <div class="wit-vdo-modal" id="wit-vdo-modal">
	<div class="wit-vdo-modal-overlay"></div>
	<div class="wit-vdo-modal-content">
		<div class="wit-vdo-modal-header">
			<h3>Video/Reels</h3>
			<button class="wit-vdo-modal-close" id="wit-vdo-modal-close" title="Close">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-Close_MD.svg" alt="Close">
			</button>
		</div>

		<div class="wit-vdo-modal-body">
			<div class="wit-vdo-modal-grid" id="wit-vdo-modal-grid">
				<!-- vdo images -->
				<div class="wit-vdo-modal-item wit-vdo-modal-single">
					<div class="wit-vdo-iframe_wrapper">
						<!-- <iframe src="https://www.youtube.com/embed/DW3-bdx10YM" frameborder="0" allowfullscreen
              width="100%" height="100%"></iframe> -->
					</div>
				</div>
				<div class="wit-vdo-modal-item wit-vdo-modal-single">
					<div class="wit-vdo-iframe_wrapper">
						<!-- <iframe src="https://www.youtube.com/embed/DW3-bdx10YM" frameborder="0" allowfullscreen
              width="100%" height="100%"></iframe> -->
					</div>
				</div>
				<div class="wit-vdo-modal-item wit-vdo-modal-single">
					<div class="wit-vdo-iframe_wrapper">
						<!-- <iframe src="https://www.youtube.com/embed/DW3-bdx10YM" frameborder="0" allowfullscreen
              width="100%" height="100%"></iframe> -->
					</div>
				</div>
				<div class="wit-vdo-modal-item wit-vdo-modal-single">
					<div class="wit-vdo-iframe_wrapper">
						<!-- <iframe src="https://www.youtube.com/embed/DW3-bdx10YM" frameborder="0" allowfullscreen
              width="100%" height="100%"></iframe> -->
					</div>
				</div>
				<div class="wit-vdo-modal-item wit-vdo-modal-single">
					<div class="wit-vdo-iframe_wrapper">
						<!-- <iframe src="https://www.youtube.com/embed/DW3-bdx10YM" frameborder="0" allowfullscreen
              width="100%" height="100%"></iframe> -->
					</div>
				</div>
				<div class="wit-vdo-modal-item wit-vdo-modal-single">
					<div class="wit-vdo-iframe_wrapper">
						<!-- <iframe src="https://www.youtube.com/embed/DW3-bdx10YM" frameborder="0" allowfullscreen
              width="100%" height="100%"></iframe> -->
					</div>
				</div>
				<div class="wit-vdo-modal-item wit-vdo-modal-single">
					<div class="wit-vdo-iframe_wrapper">
						<!-- <iframe src="https://www.youtube.com/embed/DW3-bdx10YM" frameborder="0" allowfullscreen
              width="100%" height="100%"></iframe> -->
					</div>
				</div>
				<div class="wit-vdo-modal-item wit-vdo-modal-single">
					<div class="wit-vdo-iframe_wrapper">
						<!-- <iframe src="https://www.youtube.com/embed/DW3-bdx10YM" frameborder="0" allowfullscreen
              width="100%" height="100%"></iframe> -->
					</div>
				</div>
				<div class="wit-vdo-modal-item wit-vdo-modal-single">
					<div class="wit-vdo-iframe_wrapper">
						<!-- <iframe src="https://www.youtube.com/embed/DW3-bdx10YM" frameborder="0" allowfullscreen
              width="100%" height="100%"></iframe> -->
					</div>
				</div>
				<div class="wit-vdo-modal-item wit-vdo-modal-single">
					<div class="wit-vdo-iframe_wrapper">
						<!-- <iframe src="https://www.youtube.com/embed/DW3-bdx10YM" frameborder="0" allowfullscreen
              width="100%" height="100%"></iframe> -->
					</div>
				</div>
				<div class="wit-vdo-modal-item wit-vdo-modal-single">
					<div class="wit-vdo-iframe_wrapper">
						<!-- <iframe src="https://www.youtube.com/embed/DW3-bdx10YM" frameborder="0" allowfullscreen
              width="100%" height="100%"></iframe> -->
					</div>
				</div>
				<div class="wit-vdo-modal-item wit-vdo-modal-single">
					<div class="wit-vdo-iframe_wrapper">
						<!-- <iframe src="https://www.youtube.com/embed/DW3-bdx10YM" frameborder="0" allowfullscreen
              width="100%" height="100%"></iframe> -->
					</div>
				</div>
				<div class="wit-vdo-modal-item wit-vdo-modal-single">
					<div class="wit-vdo-iframe_wrapper">
						<!-- <iframe src="https://www.youtube.com/embed/DW3-bdx10YM" frameborder="0" allowfullscreen
              width="100%" height="100%"></iframe> -->
					</div>
				</div>
				<div class="wit-vdo-modal-item wit-vdo-modal-single">
					<div class="wit-vdo-iframe_wrapper">
						<!-- <iframe src="https://www.youtube.com/embed/DW3-bdx10YM" frameborder="0" allowfullscreen
              width="100%" height="100%"></iframe> -->
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<!-- Vdo Single Modal -->
<div class="wit-vdo-single-modal" id="wit-vdo-single-modal">
	<div class="wit-vdo-modal-overlay"></div>
	<div class="wit-vdo-modal-content">
		<div class="wit-vdo-modal-header">
			<button class="wit-vdo-modal-close" id="wit-vdo-single-modal-close" title="Close">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-Close_MD_white.svg" alt="Close">
			</button>
		</div>

		<div class="wit-vdo-modal-body">
			<div class="wit-vdo-modal-single-swiper swiper">
				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<div class="wit-vdo-card">
							<div class="wit-vdo-card_img">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/vdo-2.png" alt="">
							</div>
							<div class="wit-vdo-card_icon">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-play.svg" alt="">
							</div>
							<p class="wit-vdo-card_name">
								Group Dancing
							</p>

						</div>

					</div>
					<div class="swiper-slide">
						<div class="wit-vdo-card">
							<div class="wit-vdo-card_img">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/vdo-2.png" alt="">
							</div>
							<div class="wit-vdo-card_icon">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-play.svg" alt="">
							</div>
							<p class="wit-vdo-card_name">
								Group Dancing
							</p>

						</div>

					</div>
					<div class="swiper-slide">
						<div class="wit-vdo-card">
							<div class="wit-vdo-card_img">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/vdo-2.png" alt="">
							</div>
							<div class="wit-vdo-card_icon">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-play.svg" alt="">
							</div>
							<p class="wit-vdo-card_name">
								Group Dancing
							</p>

						</div>

					</div>
					<div class="swiper-slide">
						<div class="wit-vdo-card">
							<div class="wit-vdo-card_img">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/vdo-2.png" alt="">
							</div>
							<div class="wit-vdo-card_icon">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-play.svg" alt="">
							</div>
							<p class="wit-vdo-card_name">
								Group Dancing
							</p>

						</div>

					</div>
				</div>
				<div class="wit-swiper-button swiper-button-prev">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-arrow-left.svg" alt="Arrow Left">
				</div>
				<div class="wit-swiper-button swiper-button-next">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-arrow-left.svg" alt="Arrow Right">
				</div>

			</div>
			<div class="wit-swiper-vdo-thumbnails">
				<div class="swiper wit-swiper-vdo-thumbnails-swiper">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/gallery-1.png" alt="Thumbnail 1">
						</div>
						<div class="swiper-slide">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/gallery-1.png" alt="Thumbnail 2">
						</div>
						<div class="swiper-slide">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/gallery-1.png" alt="Thumbnail 3">
						</div>
						<div class="swiper-slide">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/gallery-1.png" alt="Thumbnail 4">
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div> */ ?>
<?php get_component('/footer.php'); ?>