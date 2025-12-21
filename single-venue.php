<?php get_component('/header.php'); ?>
<?php $fields = get_fields() ?>
<div class="debug floating-debugger">
	<pre class="floating-debugger-content"><?php print_r($fields); ?></pre>
	<button class="floating-debugger-toggle">
		&#9733;
	</button>
</div>
<main class="flex flex-col gap-6">
	<section class="wit-sc_header_venue pt-6 lg:pt-8">
		<div class="container">
			<div class="wit-sc_inner flex flex-col gap-4">
				<a href="<?php echo get_post_type_archive_link('venue'); ?>" class="wit-link flex items-center gap-1">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-arrow-left.svg" alt="" class="w-4 h-4"> View other venues
				</a>
				<?php
				if (!empty($fields['Banner'])) :
					$banners = $fields['Banner'];
				?>
					<div class="wit-sc_header_venue_img_wrapper">

						<?php $bannerIndex = 1;
						foreach ($banners as $banner) :
							if ($bannerIndex <= 3) : ?>
								<div class="wit-sc_header_venue_img_wrapper_img wit-gallery-modal-single">
									<img src="<?php echo esc_url($banner['url']); ?>" alt="">
									<?php if (count($banners) > 3 && $bannerIndex === 3) : ?>
										<div class="wit-sc_header_venue_img_wrapper_img_overlay">
											+<?php echo count($banners) - 3; ?>
										</div>
									<?php endif; ?>
								</div>
						<?php endif;
							$bannerIndex++;
						endforeach; ?>

						<!-- Mobile Swiper Layout -->
						<div class="wit-sc_header_venue_swiper swiper">
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
	<section class="wit-sc_venue_content">
		<div class="container">
			<div class="wit-sc_venue_content_inner">
				<div class="wit-sc_venue_content_inner_left">
					<section class="wit-sc_venue_description">
						<div class="wit-sc_inner flex flex-col gap-1">
							<div class="wit-sc_inner-header">
								<h2><?php the_title(); ?></h2>
							</div>

							<?php if (!empty($fields['Perk'])) : ?>
								<div class="wit-tag_wrapper">
									<?php foreach ($fields['Perk'] as $perk) { ?>
										<div class="wit-tag"><?php echo get_term($perk)->name; ?></div>
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

					<section class="wit-sc_venue_details">
						<div class="wit-sc_inner">
							<?php if (!empty($fields['Destination']->ID)) : ?>
								<div class="wit-sc_venue_details_location">
									<a href="<?php echo the_permalink($fields['Destination']->ID) ?>" class="wit-link">
										<?php echo $fields['Destination']->post_title; ?>
									</a>

									<p>
										<?php if (!empty($fields['Address'])) : ?>
											<?php echo $fields['Address']; ?>
										<?php endif; ?>
									</p>
									<div class="wit-sc_venue_location_map">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/location-thailand.png" alt="">
									</div>
								</div>
							<?php endif; ?>

							<?php if (!empty($fields['Language'])) : ?>
								<p class="text-xs font-normal text-[#060606]">Languages Spoken:
									<?php foreach ($fields['Language'] as $language) {
										$language_names[] = get_term($language)->name;
									}
									echo implode(', ', $language_names); ?>
								</p>
							<?php endif; ?>

							<?php if (!empty($fields['PriceStart']) || $fields['Guest']) : ?>
								<div class="wit-sc_venue_details_price_capacity flex flex-col gap-2">
									<?php if (!empty($fields['PriceStart'])) : ?>
										<div class="wit-sc_venue_details_price">
											<h4 class="text-xl font-semibold text-[#060606]"><?php echo number_format($fields['PriceStart']); ?> THB</h4>
											<p class="text-xs font-normal text-[#595959]">Starting Price</p>
										</div>
									<?php endif; ?>
									<?php if (!empty($fields['Guest'])) : ?>
										<div class="wit-sc_venue_details_capacity">
											<h4 class="text-xl font-semibold text-[#060606]"><?php echo number_format($fields['Guest']); ?> +</h4>
											<p class="text-xs font-normal text-[#595959]">Guest Capacity</p>
										</div>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>
					</section>

					<?php if (!empty($fields['Tagline'])) : ?>
						<section class="wit-sc_venue_amenities">
							<div class="wit-sc_inner">
								<?php foreach ($fields['Tagline'] as $tagline) { ?>
									<div class="wit-amenities_card">
										<p><?php echo get_term($tagline)->name; ?></p>
									</div>
								<?php } ?>

							</div>
						</section>
					<?php endif; ?>

					<?php if (!empty($fields['Package'])) : ?>
					<section class="wit-sc_venue_packages">
						<div class="wit-sc_inner">
							<div class="wit-sc_inner-header">
								<h2>Package</h2>
							</div>
							<?php if (!empty($fields['AllPackageBrochure'])) : ?>
								<a href="<?php echo esc_url($fields['AllPackageBrochure']['url']); ?>"
									class="wit-link text-xs text-[#017DA9] font-normal flex items-center justify-end gap-1">
									Download All Package Brochure <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-file_download.svg" alt=""></a>
							<?php endif; ?>

							<?php if (!empty($fields['Package'])) : ?>

								<div class="wit-sc_venue_packages_list">
									<div class="wit-accordion">
										<?php $packageIndex = 1;
										foreach ($fields['Package'] as $package) : ?>
											<div class="wit-accordion-item">
												<div class="wit-accordion-header" data-accordion-target="accordion-<?php echo $packageIndex; ?>">
													<h3>
														<?php echo $package['PackageName']; ?>
														<?php if ($package['PackageRecommended']) : ?>
															<span class="wit-badge">Recommended</span>
														<?php endif; ?>
													</h3>
													<div class="wit-accordion-header_icon">
														<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-chevron_down.svg" alt="">
													</div>
												</div>
												<div class="wit-accordion-content" data-accordion-content="accordion-<?php echo $packageIndex; ?>">
													<div class="wit-accordion-content_header">
														<p><strong><?php echo $package['PackageDescription']; ?></strong> </p>
														<h4><?php echo number_format($package['PackagePrice']); ?> <span>THB</span></h4>
													</div>
													<?php if ($package['PackageFeature']) : ?>
														<div class="wit-accordion-content_wrapper">
															<p class="text-xs font-normal text-[#595959]">What's included:</p>
															<div class="wit-accordion-content_lists">
																<?php foreach ($package['PackageFeature'] as $feature) : ?>
																	<div class="wit-accordion-content_item">
																		<div class="wit-accordion-content_item_title"><?php echo $feature['FeatureGroupName']; ?></div>
																		<?php if ($feature['FeatureGroupList']) : ?>
																			<div class="wit-accordion-content_item_group">
																				<?php foreach ($feature['FeatureGroupList'] as $featureItem) : ?>
																					<div class="flex items-start gap-1">
																						<div>
																							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-check.svg"
																								alt="">
																						</div>
																						<p class="text-xs font-normal text-[#060606]">
																							<?php echo $featureItem['FeatureDescription']; ?>
																						</p>
																					</div>
																				<?php endforeach; ?>
																			</div>
																		<?php endif; ?>
																	</div>
																<?php endforeach; ?>
															</div>
														</div>
													<?php endif; ?>
													<p class="text-[10px] text-[#595959] font-normal">Note:
														<?php echo $package['PackageRemark']; ?>
													</p>
													<?php if ($package['PackageBrochure']) : ?>

														<div class="flex justify-end">
															<a href="<?php echo esc_url($package['PackageBrochure']['url']); ?>"
																class="wit-btn wit-btn_secondary w-full max-w-[343px]">Download
																Brochure
																(.PDF)</a>
														</div>
													<?php endif; ?>


												</div>

											</div>
										<?php $packageIndex++;
										endforeach; ?>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</section>
					<?php endif; ?>

					<!-- section gallery -->
					<?php if (!empty($fields['Gallery'])) : ?>
						<section class="wit-sc_gallery">
							<div class="wit-sc_inner">
								<div class="wit-sc_inner-header">
									<h2>Gallery</h2>
									<div class="wit-sc_inner-header_right">

										<div class="wit-swiper-button">

											<div class="swiper-button-prev wit-swiper-button-prev"></div>
											<div class="swiper-button-next wit-swiper-button-next"></div>
										</div>

										<a href="#" class="wit-link wit-gallery-modal-trigger">View All

											<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-arrow-left.svg" alt=""
												class="wit-link_icon">
										</a>
									</div>
								</div>
								<div class="swiper wit-swiper wit-gallery-modal-single" data-slides="1" data-space="16">
									<div class="swiper-wrapper">
										<?php foreach ($fields['Gallery'] as $gallery) : ?>
											<div class="swiper-slide">
												<div class="wit-gallery-img_wrapper">
													<img src="<?php echo wp_get_attachment_url($gallery['ID']); ?>" alt="">
												</div>
											</div>
										<?php endforeach; ?>
									</div>
									<div class="swiper-pagination wit-swiper-gallery-pagination"></div>
									<div class="wit-gallery-total_img">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-Image_01.svg" alt="">
										<span id="wit-gallery-total_number">56</span>
									</div>
								</div>
							</div>
						</section>
					<?php endif; ?>

					<?php $relatedVideos = new WP_Query([
						'post_type' => 'video',
						'posts_per_page' => -1,
						'meta_query' => [
							[
								'key' => 'RelatedVenue',
								'value' => get_the_ID(),
								'compare' => 'LIKE'
							]
						]
					]);

					if ($relatedVideos->have_posts()) : ?>
					<section class="wit-sc_vdo">
						<div class="wit-sc_inner">
							<div class="wit-sc_inner-header">
								<h2>Video/Reels</h2>
								<div class="wit-sc_inner-header_right">
									<div class="wit-swiper-button">
										<div class="swiper-button-prev wit-swiper-button-prev"></div>
										<div class="swiper-button-next wit-swiper-button-next"></div>
									</div>

									<a href="<?php echo get_post_type_archive_link('video').'?venue='.get_the_ID(); ?>" class="wit-link wit-vdo-modal-trigger">View All
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-arrow-left.svg" alt=""
											class="wit-link_icon">
									</a>
								</div>
							</div>
							<div class="swiper wit-swiper wit-vdo-modal-single" data-slides="2.25" data-space="16" data-breakpoints='{"992":{"slidesPerView":2.7}}'>
								<div class="swiper-wrapper">
									<?php while ($relatedVideos->have_posts()) : $relatedVideos->the_post(); ?>
									<div class="swiper-slide">
										<?php get_component('/card-video.php'); ?>
									</div>
									<?php endwhile; wp_reset_postdata(); ?>
								</div>
								<div class="swiper-pagination wit-swiper-gallery-pagination"></div>

							</div>
						</div>
					</section>
					<?php wp_reset_postdata();
					endif; ?>

					<?php if (!empty($fields['Presentation'])) : ?>
						<?php foreach ($fields['Presentation'] as $presentation) : ?>
							<?php if ($presentation['PresentationImage']) : ?>
								<section class="wit-sc_venue_presentation">
									<div class="wit-sc_inner">
										<div class="wit-sc_inner-header">
											<h2><?php echo $presentation['PresentationName']; ?></h2>
										</div>
										<?php if ($presentation['PresentationDescription']) : ?>
											<div class="!mb-4"><?php echo $presentation['PresentationDescription']; ?></div>
										<?php endif; ?>
										<div class="overflow-hidden rounded-lg">
											<img src="<?php echo esc_url($presentation['PresentationImage']['url']); ?>" alt="<?php echo esc_attr($presentation['PresentationImage']['alt']); ?>">
										</div>
									</div>
								</section>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>

					<?php $reviewArg = [
						'post_type' => 'review',
						'posts_per_page' => -1,
						'meta_query' => [
							[
								'key' => 'ReviewRelated',
								'value' => get_the_ID(),
								'compare' => '='
							]
						]
					];
					$reviewQuery = new WP_Query($reviewArg);
					if($reviewQuery->have_posts()) : ?>
					<section class="wit-sc_wedding_stories">
						<div class="wit-sc_inner">
							<div class="wit-sc_inner-header">

								<h2>Real Wedding Stories</h2>
								<div class="wit-sc_inner-header_right">

									<div class="wit-swiper-button">

										<div class="swiper-button-prev wit-swiper-button-prev"></div>
										<div class="swiper-button-next wit-swiper-button-next"></div>
									</div>
								</div>


							</div>

							<div class="swiper wit-swiper" data-slides="1.8" data-space="8" data-breakpoints='{"450":{"slidesPerView":2.8},"768":{"slidesPerView":3.1},"992":{"slidesPerView":3.5}}'>
								<div class="swiper-wrapper">
									<?php while($reviewQuery->have_posts()) : $reviewQuery->the_post(); ?>
									<div class="swiper-slide">
										<?php get_component('/card-review.php'); ?>
									</div>
									<?php endwhile; ?>
								</div>
								<div class="swiper-pagination wit-swiper-card-pagination"></div>
							</div>
						</div>
					</section>
					<?php wp_reset_postdata();
					endif; ?>

					<?php if ( !empty($fields['FAQs'])) : ?>
					<section class="wit-sc_venue_faq">
						<div class="wit-sc_inner">
							<div class="wit-sc_inner-header">
								<h2>FAQ</h2>
							</div>

							<div class="wit-sc_venue_faq_list">
								<div class="wit-accordion">
									<?php $faqIndex = 1;
									foreach($fields['FAQs'] as $faq) : ?>
									<div class="wit-accordion-item">
										<div class="wit-accordion-header" data-accordion-target="accordion-faq-1">
											<h3><?php echo $faq['FAQTitle']; ?></h3>
											<div class="wit-accordion-header_icon">
												<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-chevron_down.svg" alt="">
											</div>
										</div>
										<div class="wit-accordion-content" data-accordion-content="accordion-faq-1">
											<div class="flex flex-col gap-2">
												<?php echo $faq['FAQ_Content']; ?>
											</div>
										</div>
									</div>
									<?php $faqIndex++;
									endforeach; ?>
								</div>
							</div>
						</div>
					</section>
					<?php endif; ?>
					
					<section class="wit-sc_wedding_stories">
						<div class="wit-sc_inner">
							<div class="wit-sc_inner-header">
								<h2>Real Wedding Stories</h2>
								<div class="wit-sc_inner-header_right">
									<div class="wit-swiper-button">
										<div class="swiper-button-prev wit-swiper-button-prev"></div>
										<div class="swiper-button-next wit-swiper-button-next"></div>
									</div>
								</div>
							</div>

							<div class="swiper wit-swiper" data-slides="1.8" data-space="16" data-breakpoints='{"450":{"slidesPerView":2.2},"768":{"slidesPerView":2.74}}'>
								<div class="swiper-wrapper">
									<div class="swiper-slide">
										<a href="#">
											<div class="wit-card-date">
												<div class="wit-card-img_wrapper">
													<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/blog-1.png" alt="">
												</div>



												<div class="wit-card-content">
													<h5 class="wit-card-title">Best Time of Year for Weddings in
														Thailand
													</h5>
													<p class="wit-card-desc">With its tropical climate, Thailand has
														peak and off-peak seasons. Learn when to book for the best
														weather and least crowded venues for your nuptials.</p>

													<div
														class="flex items-center gap-1 text-[#595959] text-[10px] font-normal">
														<p>4 min read</p>
														<p>|</p>
														<p>5 days ago</p>
													</div>

												</div>
											</div>

										</a>
									</div>
									<div class="swiper-slide">
										<a href="#">
											<div class="wit-card-date">
												<div class="wit-card-img_wrapper">
													<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/blog-2.png" alt="">
												</div>



												<div class="wit-card-content">
													<h5 class="wit-card-title">Best Time of Year for Weddings in
														Thailand
													</h5>
													<p class="wit-card-desc">With its tropical climate, Thailand has
														peak and off-peak seasons. Learn when to book for the best
														weather and least crowded venues for your nuptials.</p>

													<div
														class="flex items-center gap-1 text-[#595959] text-[10px] font-normal">
														<p>4 min read</p>
														<p>|</p>
														<p>5 days ago</p>
													</div>

												</div>
											</div>

										</a>
									</div>

									<div class="swiper-slide">
										<a href="#">
											<div class="wit-card-date">
												<div class="wit-card-img_wrapper">
													<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/blog-3.png" alt="">
												</div>



												<div class="wit-card-content">
													<h5 class="wit-card-title">Cultural Elements to Include in Your
														Thai Wedding
													</h5>
													<p class="wit-card-desc">Incorporate traditional Thai customs
														into your ceremony, such as a water blessing or the 'Khan
														Maak' procession, to add a unique and authentic touch to
														your wedding.</p>

													<div
														class="flex items-center gap-1 text-[#595959] text-[10px] font-normal">
														<p>6 min read</p>
														<p>|</p>
														<p>1 week ago</p>
													</div>

												</div>
											</div>

										</a>
									</div>


								</div>
								<div class="swiper-pagination wit-swiper-card-pagination"></div>
							</div>
						</div>

					</section>


					<section class="wit-sc_featured_venue">
						<div class="wit-sc_inner">
							<div class="wit-sc_inner-header">

								<h2>Featured Venue</h2>
								<div class="wit-sc_inner-header_right">

									<div class="wit-swiper-button">

										<div class="swiper-button-prev wit-swiper-button-prev"></div>
										<div class="swiper-button-next wit-swiper-button-next"></div>
									</div>
								</div>


							</div>

							<div class="swiper wit-swiper" data-slides="1.2" data-space="24" data-breakpoints='{"450":{"slidesPerView":2.2},"768":{"slidesPerView":2.45}}'>
								<div class="swiper-wrapper">
									<div class="swiper-slide">
										<?php get_component('/card-venue-1.php'); ?>
									</div>
									<div class="swiper-slide">
										<?php get_component('/card-venue-1.php'); ?>
									</div>
									<div class="swiper-slide">
										<?php get_component('/card-venue-1.php'); ?>
									</div>
									<div class="swiper-slide">
										<?php get_component('/card-venue-1.php'); ?>
									</div>
									<div class="swiper-slide">
										<?php get_component('/card-venue-1.php'); ?>
									</div>
								</div>
								<div class="swiper-pagination wit-swiper-card-pagination"></div>
							</div>
						</div>

					</section>


				</div>
				<div class="wit-sc_venue_content_inner_right">
					<div class="wit-sc_contact_venue">
						<div class="wit-sc_inner">
							<a href="" class="wit-btn wit-btn_primary">Inquiry</a>
							<a href="" class="wit-btn wit-btn_border">Estimate Your Budget</a>
							<a href=""
								class="wit-btn wit-btn_secondary flex items-center justify-center gap-2.5">Contact
								Admin <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-line.svg" alt=""></a>
						</div>
					</div>
				</div>
			</div>
		</div>


	</section>
</main>

<!-- Gallery Modal -->
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
			<button class="wit-gallery-modal-tab" data-category="ceremony">Ceremony</button>
			<button class="wit-gallery-modal-tab" data-category="reception">Reception</button>
			<button class="wit-gallery-modal-tab" data-category="styling">Styling</button>
			<button class="wit-gallery-modal-tab" data-category="real-weddings">Real Weddings</button>
			<button class="wit-gallery-modal-tab" data-category="lighting">Lighting & Ambience</button>
			<button class="wit-gallery-modal-tab" data-category="after-party">After Party</button>
		</div>

		<div class="wit-gallery-modal-body">
			<div class="wit-gallery-modal-grid" id="wit-gallery-modal-grid">
				<!-- Gallery images -->
				<div class="wit-gallery-modal-item wit-gallery-modal-single" data-category="ceremony">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/gallery-1.png" alt="Gallery Image 1">
				</div>
				<div class="wit-gallery-modal-item wit-gallery-modal-single" data-category="reception">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/header-venue-2.png" alt="Gallery Image 2">
				</div>
				<div class="wit-gallery-modal-item wit-gallery-modal-single" data-category="styling">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/header-venue-3.png" alt="Gallery Image 3">
				</div>
				<div class="wit-gallery-modal-item wit-gallery-modal-single" data-category="real-weddings">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/gallery-1.png" alt="Gallery Image 4">
				</div>
				<div class="wit-gallery-modal-item wit-gallery-modal-single" data-category="lighting">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/header-venue-2.png" alt="Gallery Image 5">
				</div>
				<div class="wit-gallery-modal-item wit-gallery-modal-single" data-category="after-party">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/header-venue-3.png" alt="Gallery Image 6">
				</div>
				<div class="wit-gallery-modal-item wit-gallery-modal-single" data-category="ceremony">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/gallery-1.png" alt="Gallery Image 7">
				</div>
				<div class="wit-gallery-modal-item wit-gallery-modal-single" data-category="reception">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/header-venue-2.png" alt="Gallery Image 8">
				</div>
				<div class="wit-gallery-modal-item wit-gallery-modal-single" data-category="styling">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/header-venue-3.png" alt="Gallery Image 9">
				</div>
				<div class="wit-gallery-modal-item wit-gallery-modal-single" data-category="real-weddings">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/gallery-1.png" alt="Gallery Image 10">
				</div>
				<div class="wit-gallery-modal-item wit-gallery-modal-single" data-category="lighting">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/header-venue-2.png" alt="Gallery Image 11">
				</div>
				<div class="wit-gallery-modal-item wit-gallery-modal-single" data-category="after-party">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/header-venue-3.png" alt="Gallery Image 12">
				</div>
				<div class="wit-gallery-modal-item wit-gallery-modal-single" data-category="ceremony">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/gallery-1.png" alt="Gallery Image 13">
				</div>
				<div class="wit-gallery-modal-item wit-gallery-modal-single" data-category="reception">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/header-venue-2.png" alt="Gallery Image 14">
				</div>
				<div class="wit-gallery-modal-item wit-gallery-modal-single" data-category="styling">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/header-venue-3.png" alt="Gallery Image 15">
				</div>
				<div class="wit-gallery-modal-item wit-gallery-modal-single" data-category="real-weddings">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/gallery-1.png" alt="Gallery Image 16">
				</div>
				<div class="wit-gallery-modal-item wit-gallery-modal-single" data-category="lighting">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/header-venue-2.png" alt="Gallery Image 17">
				</div>
				<div class="wit-gallery-modal-item wit-gallery-modal-single" data-category="after-party">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/header-venue-3.png" alt="Gallery Image 18">
				</div>
				<div class="wit-gallery-modal-item wit-gallery-modal-single" data-category="ceremony">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/gallery-1.png" alt="Gallery Image 19">
				</div>
				<div class="wit-gallery-modal-item wit-gallery-modal-single" data-category="reception">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/header-venue-2.png" alt="Gallery Image 20">
				</div>
			</div>
		</div>
	</div>
</div>
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
					<div class="swiper-slide">
						<div class="wit-gallery-modal-single-img_wrapper">

							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/gallery-1.png" alt="Gallery Image 1">
						</div>
					</div>
					<div class="swiper-slide">
						<div class="wit-gallery-modal-single-img_wrapper">

							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/gallery-1.png" alt="Gallery Image 1">
						</div>
					</div>
					<div class="swiper-slide">
						<div class="wit-gallery-modal-single-img_wrapper">

							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/gallery-1.png" alt="Gallery Image 1">
						</div>
					</div>
					<div class="swiper-slide">
						<div class="wit-gallery-modal-single-img_wrapper">

							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pages/single-venue/gallery-1.png" alt="Gallery Image 1">
						</div>
					</div>
				</div>
				<div class="wit-gallery-total_img">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ic-Image_01.svg" alt="">
					<span id="wit-gallery-total_number">56</span>
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
</div>

<!-- Vdo Modal -->
<div class="wit-vdo-modal" id="wit-vdo-modal">
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
</div>
<?php get_component('/footer.php'); ?>