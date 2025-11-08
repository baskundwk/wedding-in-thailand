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

add_action('init', 'setUserCountryCode');

function setUserCountryCode() {
		if(isset($_COOKIE['cityguide-countryCode'])) {
			return sanitize_text_field($_COOKIE['cityguide-countryCode']);
		} else {
			$ip;
			// Prefer HTTP_X_FORWARDED_FOR if available (e.g., behind a proxy)
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
					$ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
					// Might contain multiple IPs - take the first one
					$ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
					$ip = trim($ipList[0]);
			} else {
					$ip = $_SERVER['REMOTE_ADDR'];
			}
	
			// Skip calling the API if IP is localhost
			if ($ip === '127.0.0.1' || $ip === '::1') {
					$countryCode = 'th';
			} else {
					$countryCode = strtolower(@file_get_contents("https://ipapi.co/{$ip}/country/"));
					if ($countryCode === false) {
							$countryCode = 'th';
					}
			}

			setcookie('cityguide-countryCode', htmlspecialchars(trim($countryCode)), time() + (86400 * 30), '/');
	
			return htmlspecialchars(trim($countryCode));
		}
}
function getUserCountryCode() {
		if(isset($_COOKIE['cityguide-countryCode'])) {
			//print_r($_COOKIE['cityguide-countryCode']);
			return $_COOKIE['cityguide-countryCode'];
		} else {
			return 'th';
		}
}


function set_query_defaults( $query ) {
	if ( !is_admin() && $query->is_main_query() && $query->is_archive() ) {
		$query->set( 'posts_per_page', 26 );
		$query->set( 'paged', get_query_var('paged') ? get_query_var('paged') : 1 );
		$query->set( 'meta_query', [
			'clause_priority' => [
				'key' => 'feature_enabled',
				'type' => 'NUMERIC'
			]
		]);
	}
}
add_action( 'pre_get_posts', 'set_query_defaults' );

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

?>