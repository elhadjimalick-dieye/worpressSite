<?php
/*This file is part of storement child theme.

All functions of this file will be loaded before of parent theme functions.
Learn more at https://codex.wordpress.org/Child_Themes.

Note: this function loads the parent stylesheet before, then child theme stylesheet
(leave it in place unless you know what you are doing.)
*/

function storement_enqueue_child_styles()
{
    $min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    $parent_style = 'shopical-style';
    $parent_woocommerce_style = 'shopical-woocommerce-style';

    $fonts_url = 'https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700';
    wp_enqueue_style('storement-google-fonts', $fonts_url, array(), null);

    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap' . $min . '.css');

    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/assets/owl-carousel-v2/assets/owl.carousel' . $min . '.css');
    wp_enqueue_style('owl-theme-default', get_template_directory_uri() . '/assets/owl-carousel-v2/assets/owl.theme.default.css');
    /**
     * Load WooCommerce compatibility file.
     */
    if (class_exists('WooCommerce')) {
        wp_enqueue_style($parent_woocommerce_style, get_template_directory_uri() . '/woocommerce.css');

        $font_path = WC()->plugin_url() . '/assets/fonts/';
        $inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

        wp_add_inline_style($parent_woocommerce_style, $inline_font);
    }
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    wp_enqueue_style(
        'storement-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('bootstrap', $parent_style, $parent_woocommerce_style),
        wp_get_theme()->get('Version'));


}

add_action('wp_enqueue_scripts', 'storement_enqueue_child_styles');

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function storement_customize_register($wp_customize)
{
    $wp_customize->get_setting('main_navigation_background_color')->default = '#3b496c';


}

add_action('customize_register', 'storement_customize_register', 99999);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function storement_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Above Footer Section', 'storement'),
        'id' => 'above-footer-section',
        'description' => esc_html__('Add widgets to above footer section.', 'storement'),
        'before_widget' => '<div id="%1$s" class="widget shopical-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span>',
        'after_title' => '</span></h2>',
    ));
}

add_action('widgets_init', 'storement_widgets_init', 11);

/*Add the demo file*/
function storement_add_demo_files($demos)
{
    $demos[] = array(
        'import_file_name' => esc_html__('Child - Storement', 'storement'),
        'local_import_file' => trailingslashit(get_stylesheet_directory()) . 'demo-content/storement/shopical.xml',
        'local_import_widget_file' => trailingslashit(get_stylesheet_directory()) . 'demo-content/storement/shopical.wie',
        'local_import_customizer_file' => trailingslashit(get_stylesheet_directory()) . 'demo-content/storement/shopical.dat',
        'import_preview_image_url' => trailingslashit(get_stylesheet_directory_uri()) . 'demo-content/assets/shopical-storement.jpg',
        'preview_url' => 'https://demo.afthemes.com/shopical/storement',
    );
    return $demos;
}

add_filter('aft_demo_import_files', 'storement_add_demo_files');