<?php
/**
 * Custom functions that act independently of the theme templates.
 * Eventually, some of the functionality here could be replaced by core features.
 * @package pxt-ecommerce
 */

function pxt_ecommerce_RegisterBackend() {
	add_theme_page( esc_html__('Paradox Themes', 'pxt-ecommerce'), esc_html__('Paradox Themes', 'pxt-ecommerce'), 'edit_theme_options', 'about-pxt-ecommerce', 'pxt_ecommerce_Backend');
}

/**
 * Adds custom classes to the array of body classes.
 * @param array $pxt_ecommerce_classes Classes for the body element.
 * @return array
 */
function pxt_ecommerce_BodyClasses( $pxt_ecommerce_classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$pxt_ecommerce_classes[] = 'group-blog';
	}
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$pxt_ecommerce_classes[] = 'hfeed';
	}
	return $pxt_ecommerce_classes;
}

function pxt_ecommerce_Backend(){ 
	$pxt_ecommerce_url = get_template_directory_uri();
	$pxt_ecommerce_premiumImg = "{$pxt_ecommerce_url}/images/pxt-ecommerce.png";
	?>
	<div class="theme-info-wrapper">
		<div class="theme-info-inner">
			<div class="theme-info-left">
				<div class="theme-info-left-inner">
					<h2><?php echo esc_html__('Theme issues?', 'pxt-ecommerce');?></h2>
					<p>
						<?php echo esc_html__('If you are having theme related problems then please contact us through our', 'pxt-ecommerce');?> <a href="<?php echo esc_url('http://paradoxthemes.com/contact-us/')?>" target="_blank"><?php echo esc_html__('contact form', 'pxt-ecommerce');?></a>, <?php echo esc_html__('which can be found at', 'pxt-ecommerce');?> <a href="http://paradoxthemes.com/contact-us/" target="_blank"><?php echo esc_url('http://paradoxthemes.com/contact-us/')?></a>
					</p>	
					<h2><?php echo esc_html__('Need more help?', 'pxt-ecommerce');?></h2>
					<ul>
						<li><a href="http://www.paradoxthemes.com/free/pxt-ecommerce/" target="_blank"><?php echo esc_html(__('Pxt business Premium', 'pxt-ecommerce'));?></a></li>
						<li><a href="http://www.paradoxthemes.com/contact/" target="_blank"><?php echo esc_html(__('Contact Paradox themes', 'pxt-ecommerce'));?></a></li>
						<li><a href="https://wordpress.org/support/" target="_blank"><?php echo esc_html(__('WordPress Support Forum', 'pxt-ecommerce'));?></a></li>
					</ul>
					<h2><?php  echo esc_html(__('Plugin or WordPress issues?', 'pxt-ecommerce'));?></h2>
					<p><?php  echo esc_html(__('If you are experiencing issues with plugins, please contact the plugin author. 
						If you are experiencing issues with WordPress functionality then please visit the', 'pxt-ecommerce'));?> <a href="<?php  echo esc_url('https://wordpress.org/support/');?>" target="_blank"><?php echo esc_html(__('WordPress Support Forum', 'pxt-ecommerce'));?></a>.
					</p>
				</div>
			</div>
			<div class="theme-info-right">
				<a href="<?php  echo esc_url('http://www.paradoxthemes.com/free/pxt-ecommerce');?>" target="_blank">
					<img src="<?php echo esc_html($pxt_ecommerce_premiumImg);?>">
				</a>
			</div>
		</div>
	</div>
<?php }
add_filter( 'body_class', 'pxt_ecommerce_BodyClasses' );
add_action( 'admin_menu', 'pxt_ecommerce_RegisterBackend' );
