<?php
/**
 * Hooks for template header
 *
 * @package LearnPlus
 */

/**
 * Enqueue scripts and styles.
 *
 * @since 1.0
 */
function learnplus_enqueue_scripts() {
	/* Register and enqueue styles */
	wp_deregister_style( 'font-awesome' ); // Doesn't use font awesome from Visual Composer. It is older version.
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.3.0' );
	wp_register_style( 'font-flaticon', get_template_directory_uri() . '/css/flaticon.css', array(), '1.0.0' );
	wp_register_style( 'font-icons', get_template_directory_uri() . '/css/stroke.min.css', array(), '20160712' );
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.2' );
	wp_register_style( 'learnplus-fonts', learnplus_fonts_url(), array(), '20160712' );

	wp_enqueue_style( 'learnplus', get_stylesheet_uri(), array( 'learnplus-fonts', 'bootstrap', 'font-awesome', 'font-icons', 'font-flaticon' ), '20160712' );

	wp_add_inline_style( 'learnplus', learnplus_header_scripts() );


	// Load custom color scheme file
	if ( intval( learnplus_theme_option( 'custom_color_scheme' ) ) && ( learnplus_theme_option( 'custom_color_1' ) || learnplus_theme_option( 'custom_color_2' ) ) ) {
		$upload_dir = wp_upload_dir();
		$dir        = path_join( $upload_dir['baseurl'], 'custom-css' );
		$file       = $dir . '/color-scheme.css';
		wp_enqueue_style( 'learnplus-color-scheme', $file, '20160712' );
	}

	/** Register and enqueue scripts */
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv.min.js', array(), '3.7.2' );
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'respond', get_template_directory_uri() . '/js/respond.min.js', array(), '1.4.2' );
	wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

	wp_register_script( 'learnplus-plugins', get_template_directory_uri() . "/js/plugins$min.js", array( 'jquery' ), '20160712', true );
	wp_enqueue_script( 'learnplus', get_template_directory_uri() . "/js/scripts$min.js", array( 'learnplus-plugins',  'jquery-ui-autocomplete' ), '20160712', true );


	wp_localize_script(
		'learnplus',
		'learnplus',
		array(
			'ajax_url'  => admin_url( 'admin-ajax.php' ),
			'nonce'     => wp_create_nonce( '_learnplus_nonce' ),
			'direction' => is_rtl() ? 'rtl' : '',
			'search_results' => esc_html__( 'Search Results for', 'learnplus' ),
			'all_results'    => esc_html__( 'All Results', 'learnplus' )
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'learnplus_enqueue_scripts' );

/**
 * Custom scripts and styles on header
 *
 * @since  1.0.0
 */
function learnplus_header_scripts() {
	/**
	 * All Custom CSS rules
	 */
	$inline_css = '';


	// Logo
	$logo_size_width = intval( learnplus_theme_option( 'logo_size_width' ) );
	$logo_css        = $logo_size_width ? 'width:' . $logo_size_width . 'px; ' : '';

	$logo_size_height = intval( learnplus_theme_option( 'logo_size_height' ) );
	$logo_css .= $logo_size_height ? 'height:' . $logo_size_height . 'px; ' : '';

	$logo_margin_top = intval( learnplus_theme_option( 'logo_margin_top' ) );
	$logo_css .= $logo_margin_top ? 'margin-top:' . $logo_margin_top . 'px;' : '';

	$logo_margin_right = intval( learnplus_theme_option( 'logo_margin_right' ) );
	$logo_css .= $logo_margin_right ? 'margin-right:' . $logo_margin_right . 'px;' : '';

	$logo_margin_bottom = intval( learnplus_theme_option( 'logo_margin_bottom' ) );
	$logo_css .= $logo_margin_bottom ? 'margin-bottom:' . $logo_margin_bottom . 'px;' : '';

	$logo_margin_left = intval( learnplus_theme_option( 'logo_margin_left' ) );
	$logo_css .= $logo_margin_left ? 'margin-left:' . $logo_margin_bottom . 'px;' : '';

	if ( ! empty( $logo_css ) ) {
		$inline_css .= '.site-header .logo img ' . ' {' . $logo_css . '}';
	}

	// Custom CSS from singule post/page
	$css_custom = learnplus_get_meta( 'custom_page_css' ) . learnplus_theme_option( 'custom_css' );
	if ( ! empty( $css_custom ) ) {
		$inline_css .= $css_custom;
	}

	// Output CSS
	if ( ! empty( $inline_css ) ) {
		echo '<style type="text/css">' . $inline_css . '</style>';
	}

	return $inline_css;

}

if ( ! function_exists( 'learnplus_show_topbar' ) ) :
/**
 * Display topbar on top of site
 *
 * @since 1.0.0
 */
function learnplus_show_topbar() {
	if ( ! learnplus_theme_option( 'topbar' ) ) {
		return;
	}
	?>
	<div id="topbar" class="topbar">
		<div class="container">
			<div class="row">
				<div class="topbar-left topbar-widgets col-sm-6 col-md-6 text-left hidden-xs">
					<?php if ( is_active_sidebar( 'topbar-left' ) ) : ?>
						<?php dynamic_sidebar( 'topbar-left' ); ?>
					<?php endif; ?>
				</div>
				<div class="topbar-right topbar-widgets col-xs-12 col-sm-6 col-md-6 text-right">
					<?php if ( is_active_sidebar( 'topbar-right' ) ) : ?>
						<?php dynamic_sidebar( 'topbar-right' ); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
endif;

add_action( 'learnplus_before_header', 'learnplus_show_topbar', 5 );

if ( ! function_exists( 'learnplus_show_header' ) ) :
/**
 * Display the site header
 *
 * @since 1.0.0
 */
function learnplus_show_header() {
	?>
	<div class="container">
		<div class="navbar row" role="navigation">
			<div class="navbar-header col-xs-12 col-sm-12 col-md-3">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="fa fa-bars"></span>
				</button>
				<?php get_template_part( 'parts/logo' ); ?>
			</div><!-- end navbar-header -->

			<nav id="site-navigation" class="primary-nav nav col-xs-12 col-md-9">
				<div class="main-nav">
					<?php
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'container'      => false,
								'walker'         => new LearnPlus_Walker_Mega_Menu,
							)
						);
					}
					?>
				</div>

				<?php if ( is_active_sidebar( 'header-right' ) && learnplus_theme_option( 'header_layout' ) == 'header-left' ) : ?>
					<div class="header-right header-widgets hidden-md hidden-xs hidden-sm col-lg-3">
						<?php
						ob_start();
						dynamic_sidebar( 'header-right' );
						$header_right = ob_get_clean();
						echo apply_filters( 'learnplus_widget_header', $header_right );
						?>
					</div>
				<?php endif; ?>
			</nav>
		</div>
	</div>
	<?php
}
endif;

add_action( 'learnplus_header', 'learnplus_show_header' );

/**
 * Change archive label for shop page
 *
 * @since  1.0.0
 *
 * @param  array $args
 *
 * @return array
 */
function learnplus_breadcrumbs_labels( $args ) {
	if ( function_exists( 'is_shop' ) && is_shop() ) {
		$args['labels']['archive'] = esc_html__( 'Shop', 'learnplus' );
	}

	return $args;
}

add_filter( 'learnplus_breadcrumbs_args', 'learnplus_breadcrumbs_labels' );
