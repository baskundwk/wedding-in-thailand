<?php

function get_component($path, $data = null, $return = false) {
  $fullPath = get_stylesheet_directory(  ) . "/components" . $path;

	if ($return) {
		ob_start();
		include $fullPath;
		return ob_get_clean();
	} else {
			include $fullPath;
	}
}

add_action( 'wp_enqueue_scripts', 'enqueue_styles' );

function enqueue_styles() {
	wp_enqueue_style( 'cg-style', get_stylesheet_uri());
	wp_enqueue_style( 'phosphor-icons', get_stylesheet_directory_uri(  ).'/library/phosphor-icons/regular.css');
	wp_enqueue_style( 'swiper-css', get_stylesheet_directory_uri(  ).'/library/swiper/swiper.min.css');
	wp_enqueue_script( 'swiper-js', get_stylesheet_directory_uri(  ).'/library/swiper/swiper-bundle.min.js');
	wp_enqueue_script( 'cg-script', get_stylesheet_directory_uri(  ).'/script.js', [], '', [
		'in_footer' => true,
		'strategry' => 'defer'
	]);
}

function register_theme_menu() {
	$menus = [
    'main-menu' => __( 'Main Menu', '' ),
		'subnav-2' => __( 'Subnav Lvl 2', '' ),
		'subnav-3' => __( 'Subnav Lvl 3', '' ),
		'footer' => __( 'Footer', '' ),
		'bottom' => __( 'Bottom', '' ),
	];
	register_nav_menus( $menus );
}
add_action( 'init', 'register_theme_menu' );

function handle_member_email_submission() {
	if (isset($_POST['email']) && is_email($_POST['email'])) {
			$email = sanitize_email($_POST['email']);

			// Optional: prevent duplicates
			$existing = get_posts([
					'post_type' => 'member',
					'title' => $email,
					'posts_per_page' => 1,
					'fields' => 'ids'
			]);

			if (empty($existing)) {
				wp_insert_post([
						'post_title'  => $email,
						'post_type'   => 'member',
						'post_status' => 'publish'
				]);
				// Redirect after submission
				wp_redirect(home_url('/thank-you/'));
			} else {
				wp_redirect(home_url('/email-exist/'));
			}
		exit;
	}
	wp_redirect(home_url('/invalid-email/'));
	exit;
}

add_action('admin_post_nopriv_handle_member_email', 'handle_member_email_submission');
add_action('admin_post_handle_member_email', 'handle_member_email_submission');

function handle_package_submission() {
	if (isset($_POST['email']) && is_email($_POST['email'])) {
			$name = sanitize_text_field($_POST['name']);
			$email = sanitize_email($_POST['email']);
			$tel = sanitize_text_field($_POST['tel']);
			$date_raw = $_POST['date'];
			$date_obj = DateTime::createFromFormat('Y-m-d', $date_raw);
			$date = ($date_obj && $date_obj->format('Y-m-d') === $date_raw) ? $date_raw : '';

			$package = sanitize_text_field($_POST['package']);

			// Optional: prevent duplicates
			/* $existing = get_posts([
					'post_type' => 'package-lead',
					'title' => $email,
					'posts_per_page' => 1,
					'fields' => 'ids'
			]); */

			if (!empty($package)) {
				$post_id = wp_insert_post([
						'post_title'  => $name,
						'post_type'   => 'package-lead',
						'post_status' => 'publish'
				]);

				// Save custom fields (post meta)
				if ($post_id && !is_wp_error($post_id)) {
						update_post_meta($post_id, 'email', $email);
						update_post_meta($post_id, 'tel', $tel);
						update_post_meta($post_id, 'date_interested', $date);
						update_post_meta($post_id, 'package', $package);
				}

				// Redirect after submission
				wp_redirect(home_url('/thank-you/'));
			} else {
				wp_redirect(home_url('/email-exist/'));
			}
		exit;
	}
	wp_redirect(home_url('/invalid-email/'));
	exit;
}

add_action('admin_post_nopriv_handle_package_submission', 'handle_package_submission');
add_action('admin_post_handle_package_submission', 'handle_package_submission');

function get_custom_meta_title() {
    if ( function_exists( 'rank_math_the_title' ) ) {
        // Rank Math active
        return rank_math_the_title();
    } else {
        // Fallback to WordPress default title
        return wp_get_document_title();
    }
}

function get_region_id() {
	$meta_key = 'featured_region'; // Replace with your actual meta key
	$slug = strtolower( getUserCountryCode() );
	$matched_post = get_posts( array(
		'meta_key'    => 'country_code',
		'meta_value'  => $slug,
		'meta_compare'=> 'LIKE',
		'post_type'   => 'region',
		'post_status' => 'publish',
		'posts_per_page' => 1,
	) );

	if ( !empty( $matched_post ) && isset( $matched_post[0]->ID ) ) {
			return $matched_post[0]->ID;
	}
	
	
	return null;
}

add_filter( 'et_project_posttype_args', 'mytheme_et_project_posttype_args', 10, 1 );
function mytheme_et_project_posttype_args( $args ) {
	return array_merge( $args, array(
		'public'              => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => false,
		'show_in_nav_menus'   => false,
		'show_ui'             => false
	));
}

// Add a dashboard widget to show the handbook link
add_action('wp_dashboard_setup', function() {
	wp_add_dashboard_widget(
		'cityguide_handbook_widget',
		'Cityguide Handbook',
		function() {
			echo get_component(
				'/dashboard/box-handbook.php',
				null,
				true
			);
		}
	);
});

add_theme_support( 'post-thumbnails' );

function wp_estimated_reading_time( $post_id = null, $wpm = 200 ) {
    $post_id = $post_id ?: get_the_ID();

    $content = get_post_field( 'post_content', $post_id );
    if ( empty( $content ) ) {
        return '';
    }

    // Strip shortcodes & HTML
    $text = wp_strip_all_tags( strip_shortcodes( $content ) );

    // Word count (multibyte-safe for Thai/Asian languages is NOT possible with word count)
    $word_count = str_word_count( $text );

    $minutes = max( 1, ceil( $word_count / $wpm ) );

    return $minutes;
}

/**
 * Custom pagination function with WP-PageNavi support and fallback
 * 
 * Usage: custom_pagination();
 * 
 * This function checks if WP-PageNavi plugin is active and uses it.
 * If not available, falls back to WordPress default pagination.
 */
function custom_pagination( $query = null ) {
    // Use global query if no specific query is provided
    if ( $query === null ) {
        global $wp_query;
        $query = $wp_query;
    }
    
    // Check if WP-PageNavi plugin is active
    if ( function_exists( 'wp_pagenavi' ) ) {
        wp_pagenavi( array( 'query' => $query ) );
    } else {
        // Fallback to default WordPress pagination
        $big = 999999999; // Need an unlikely integer
        
        $paginate_links = paginate_links( array(
            'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'    => '?paged=%#%',
            'current'   => max( 1, get_query_var( 'paged' ) ),
            'total'     => $query->max_num_pages,
            'type'      => 'list',
            'prev_text' => __( '&laquo; Previous' ),
            'next_text' => __( 'Next &raquo;' ),
            'mid_size'  => 2,
            'end_size'  => 1,
        ) );
        
        if ( $paginate_links ) {
            echo '<nav class="pagination-wrapper" aria-label="Pagination">';
            echo $paginate_links;
            echo '</nav>';
        }
    }
}

?>