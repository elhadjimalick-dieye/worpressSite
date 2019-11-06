<?php
/**
 * Jetpack Compatibility File.
 * @link https://jetpack.me/
 * @package pxt-ecommerce
 */
/**
 * Custom render function for Infinite Scroll.
 */
function pxt_ecommerce_InfiniteScrollRender() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
		    pxt_ecommerce_ArchivePost();
		else :
		    pxt_ecommerce_ArchivePost();
		endif;
	}
}

/**
 * Jetpack setup function.
 * See: https://jetpack.me/support/infinite-scroll/
 * See: https://jetpack.me/support/responsive-videos/
 */
function pxt_ecommerce_JetpackSetup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'content',
		'render'    => 'pxt_ecommerce_InfiniteScrollRender',
		'footer'    => 'site-footer',
	) );
	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'pxt_ecommerce_JetpackSetup' );
