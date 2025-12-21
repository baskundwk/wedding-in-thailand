<div class="wit-card-x">
	<div class="wit-card-img_wrapper">
		<div>
			<img src="./assets/images/pages/single-venue/wedding-stories-1.png"
				alt="">
		</div>
		<div class="wit-card-vdo">
			<img src="./assets/images/pages/single-venue/wedding-stories-1.png"
				alt="">
		</div>
		<div>
			<img src="./assets/images/pages/single-venue/wedding-stories-1.png"
				alt="">
		</div>
	</div>

	<div class="wit-card-content">
		<div class="wit-card-content_desc">
			<p class="wit-card-desc"><?php the_content(); ?></p>
			<div
				class="flex items-center gap-1 text-[#595959] text-[10px] font-normal">
				<p><?php the_title(); ?></p>
				<p>|</p>
				<p><?php echo get_field('ReviewYear'); ?></p>
			</div>
		</div>
		<p
			class="text-end text-xs font-normal text-[#060606] py-1 px-2">
			<?php echo get_field('ReviewRelated')->post_title; ?>
		</p>
	</div>
</div>