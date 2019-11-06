<?php
/**
 * Sample implementation of the Custom Header feature.
 * You can add an optional custom header image to header.php like so ...
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 * @package pxt-ecommerce
 */

/**
 * Set up the WordPress core custom header feature.
 * @uses pxt_ecommerce_HeaderStyle()
 */
function pxt_ecommerce_CustomHeaderSetup() {
	add_theme_support('custom-logo', array(
		'width'       => 155,
		'height'      => 44,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );
	add_theme_support('custom-header', array(
		'default-image'			=> '',
		'default-text-color'	=> '000',
		'width'					=> 1900,
		'height'				=> 200,
		'flex-width'			=> true,
		'flex-height'			=> true,
		'wp-head-callback'		=> 'pxt_ecommerce_HeaderStyle',
	));
}
add_action( 'after_setup_theme', 'pxt_ecommerce_CustomHeaderSetup' );
	if ( ! function_exists( 'pxt_ecommerce_HeaderStyle' ) ) {
	/**
	 * Styles the header image and text displayed on the blog.
	 * @see pxt_ecommerce_CustomHeaderSetup().
	 */
	function pxt_ecommerce_HeaderStyle() {
		$pxt_ecommerce_header_text_color = get_header_textcolor();
		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php if ( ! display_header_text() ) : ?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php else : ?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $pxt_ecommerce_header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
}
