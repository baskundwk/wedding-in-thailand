<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php wp_title('|', true, 'right'); ?></title>
	<?php wp_head(); ?>    
</head>

<body <?php body_class(); ?>>

<header class="wit-header">
  <div class="wit-header-upper">
    <div class="container flex items-center justify-center">
      <div class="wit-header-mobile-toggle">
        <button class="ph ph-list"></button>
      </div>
      <div class="wit-header-logo">
        <a href="<?php echo home_url()?>"><img src="<?php echo get_field('WITLogo', 'option')['sizes']['medium']?>" alt="Wedding in Thailand" title="Go to home page"/></a>
      </div>
      <div class="wit-header-search">
        <a class="ph ph-magnifying-glass" href="/search"></a>
      </div>
    </div>
  </div>
  <div class="wit-header-lower">
    <nav class="container flex items-center justify-start xl:justify-center">
      <?php
      wp_nav_menu(array(
        'theme_location' => 'main-menu',
        'container' => false,
        'menu_class' => 'wdl-header-menu',
        'fallback_cb' => false,
        'items_wrap' => '<ul class="%2$s">%3$s</ul>',
      ));
      ?>
    </nav>
  </div>
</header>