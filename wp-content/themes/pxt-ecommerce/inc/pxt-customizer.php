<?php
/**
 * Theme Customizer for admin
 * @package pxt-ecommerce
 */

/**
 * Add post Message support for site title and description for the Theme Customizer.
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pxt_ecommerce_CustomizeRegister($wp_customize) {
    $pxt_ecommerce_url = get_template_directory_uri();
    $pxt_ecommerce_premiumImg = "{$pxt_ecommerce_url}/images/pxt-ecommerce.png";
    // Theme Options
    $wp_customize->add_panel('panel_id', array(
        'priority' => 121,
        'capability' => 'edit_theme_options',
        'title' => __('Theme Design Options', 'pxt-ecommerce'),
        'description' => __('Theme Design Options', 'pxt-ecommerce'),
    ));
    $wp_customize->add_section(
        'pxt_ecommerce_new', array(
        'title' => __('Help & Contact', 'pxt-ecommerce'),
        'priority' => 0,
        'description' => 
            sprintf('<p>
                    <strong>'.__('Theme issues?', 'pxt-ecommerce').'</strong><br>'.
                        __('If you are having theme related problems then please contact us through our', 'pxt-ecommerce').' <a href="http://www.paradoxthemes.com/contact-us/" target="_blank">'.__('contact form', 'pxt-ecommerce').'</a>, '.__('which can be found at', 'pxt-ecommerce').' <a href="http://www.paradoxthemes.com/contact-us/" target="_blank">http://www.paradoxthemes.com/contact-us/</a>
                    </p>
                    <p>
                        <strong>'.__('Plugin or WordPress issues?', 'pxt-ecommerce').'</strong><br>'.
                        __('If you are experiencing issues with plugins, please contact the plugin author. If you are experiencing issues with WordPress functionality then please visit the', 'pxt-ecommerce').' <a href="https://wordpress.org/support/" target="_blank">'.__('WordPress Support Forum', 'pxt-ecommerce').'</a>.
                    </p>
                    <p>
                        <br>
                        <a href="http://www.paradoxthemes.com/free/pxt-ecommerce" target="_blank">
                        <img src="%s/images/pxt-ecommerce.png">
                        </a>
                    </p>'
                , $pxt_ecommerce_url)
        ));
    $wp_customize->add_setting('pxt_ecommerce_options[info]', array(
        'sanitize_callback' => 'pxt_ecommerce_NoSanitize',
        'type' => 'info_control',
        'capability' => 'edit_theme_options',
            )
    );
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'pro_section', array(
        'section' => 'pxt_ecommerce_new',
        'settings' => 'pxt_ecommerce_options[info]',
        'type' => 'label',
        'priority' => 109
            ))
    );


    /* slider customizer palate start */


    // CREATING A SECTION IN CUSTOMIZER
    $wp_customize->add_section(
        'pxt_ecommerce_slider_section',
        array(
            'title' => __( 'Slider Section', 'pxt-ecommerce' ),
            //'panel' => 'panel_id',
            'priority' =>18
        )
    );
    // show content in slider
    $wp_customize->add_setting('pxt_ecommerce_slider_show_content', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_key',
        'default' => 'on',
    ));
    $wp_customize->add_control('pxt_ecommerce_slider_show_content', array(
        'settings' => 'pxt_ecommerce_slider_show_content',
        'label' => __('Hide Title and description on slider', 'pxt-ecommerce'),
        'section' => 'pxt_ecommerce_slider_section',
        'type' => 'radio',
        'choices' => array(
            'on' => __('Yes', 'pxt-ecommerce'),
            'off' => __('No', 'pxt-ecommerce'),
        ),
    ));
    
    $pxt_ecommerce_Posts = get_posts(array('hide_empty' => 1, 'posts_per_page'=>-1, 'post_status'=>'publish', 'post_type'=>array('post', 'page')));
    foreach ($pxt_ecommerce_Posts as $pxt_ecommerce_PostsSingle) {
        $pxt_ecommerce_PostData[$pxt_ecommerce_PostsSingle->ID] = $pxt_ecommerce_PostsSingle->post_title; 
    }

    for($i = 1; $i<=4;$i++){

        $wp_customize->add_setting(
            'pxt_ecommerce_slider_'.$i,
            array(
                'sanitize_callback'=> 'absint',
                'default' => __('Select Page/Post', 'pxt-ecommerce')
            )
        );
        $wp_customize->add_control(
            'pxt_ecommerce_slider_'.$i,
            array(
                'settings'=> 'pxt_ecommerce_slider_'.$i,
                'section' => 'pxt_ecommerce_slider_section',
                'type'=>'select',
                'label'=>__('Select Page/Post', 'pxt-ecommerce'),
                'choices'=>$pxt_ecommerce_PostData
            )
        );


        /*$wp_customize->add_setting(
            'pxt_ecommerce_slider_'.$i,
            array(
                'sanitize_callback' => 'esc_url_raw'
            )
        );
        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize,
                'pxt_ecommerce_slider_'.$i,
                array(
                    'section' => 'pxt_ecommerce_slider_section',
                    'settings' => 'pxt_ecommerce_slider_'.$i,
                    'label' => __( 'Select Image ', 'pxt-ecommerce' ),
                    'description' => __('Recommended Image Size: 1900X600px', 'pxt-ecommerce')
                )
            )
        );

        $wp_customize->add_setting(
            'pxt_ecommerce_slider_title_'.$i,
            array(
                'sanitize_callback' => 'esc_html'
            )
        );
        $wp_customize->add_control('pxt_ecommerce_slider_title_'.$i, array(
            'settings' => 'pxt_ecommerce_slider_title_'.$i,
            'label' => __('Slider Title', 'pxt-ecommerce'),
            'section' => 'pxt_ecommerce_slider_section',
            'type' => 'text'
        ));

        $wp_customize->add_setting(
            'pxt_ecommerce_slider_desc_'.$i,
            array(
                'sanitize_callback' => 'esc_html'
            )
        );
        $wp_customize->add_control('pxt_ecommerce_slider_desc_'.$i, array(
            'settings' => 'pxt_ecommerce_slider_desc_'.$i,
            'label' => __('Slieder description', 'pxt-ecommerce'),
            'section' => 'pxt_ecommerce_slider_section',
            'type' => 'textarea'
        ));*/
    }

    /* slider customizer palate end */

    function pxt_ecommerce_CustomizerStylesheet() {
        wp_enqueue_style('pxt-ecommerce-customizer-css', get_template_directory_uri() . '/css/css-customizer.css', NULL, NULL, 'all');
    }

    $wp_customize->add_section('pxtBusinessStylingSettings', array(
        'title' => __('All Blog Posts Settings', 'pxt-ecommerce'),
        'priority' => 122,
        'capability' => 'edit_theme_options',
    ));


    $wp_customize->add_section('pxt_ecommerce_lite_general_layout', array(
        'title' => __('General Layout', 'pxt-ecommerce'),
        'priority' => 1,
        'capability' => 'edit_theme_options',
        'panel' => 'panel_id',
    ));
    $wp_customize->add_setting('pxtBusinessLayout', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_key',
        'default' => 'cslayout',
    ));
    $wp_customize->add_control('pxtEcommerceLayout', array(
        'settings' => 'pxtEcommerceLayout',
        'label' => __('Sidebar Position', 'pxt-ecommerce'),
        'section' => 'pxt_ecommerce_lite_general_layoutno',
        'type' => 'radio',
        'choices' => array(
            'cslayout' => __('Right Sidebar', 'pxt-ecommerce'),
            'sclayout' => __('Left Sidebar', 'pxt-ecommerce'),
        ),
    ));
    //Color Scheme
    $wp_customize->add_setting('top_header_background_color', array(
        'default' => '#FFFFFF',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'top_header_background_color', array(
        'label' => __('Header Background Color', 'pxt-ecommerce'),
        'description' => __('Applied to header background.', 'pxt-ecommerce'),
        'section' => 'colors',
        'settings' => 'top_header_background_color',
    )));
    $wp_customize->add_setting('pxtEcommerceColorScheme', array(
        'default' => '#0088cc',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'pxtEcommerceColorScheme', array(
        'label' => __('Primary Color Scheme', 'pxt-ecommerce'),
        'section' => 'colors',
        'settings' => 'pxtEcommerceColorScheme',
    )));
    $wp_customize->add_setting('pxtEcommerceColorScheme2', array(
        'default' => '#b2e9f9',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'pxtEcommerceColorScheme2', array(
        'label' => __('Secondary Color Scheme', 'pxt-ecommerce'),
        'section' => 'colors',
        'settings' => 'pxtEcommerceColorScheme2',
    )));

    //Full posts
    $wp_customize->add_setting('pxt_ecommerce_lite_full_posts', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_key',
        'default' => '0',
    ));
    $wp_customize->add_control('pxt_ecommerce_lite_full_posts', array(
        'settings' => 'pxt_ecommerce_lite_full_posts',
        'label' => __('Posts on Homepage', 'pxt-ecommerce'),
        'section' => 'pxtBusinessStylingSettings',
        'type' => 'radio',
        'choices' => array(
            '0' => __('Excerpts', 'pxt-ecommerce'),
            '1' => __('Full Posts', 'pxt-ecommerce'),
        ),
    ));

    /* Colors */
    $wp_customize->add_section('colors', array(
        'title' => __('Colors', 'pxt-ecommerce'),
        'priority' => 1,
        'capability' => 'edit_theme_options',
    ));

    /* Header */
    $wp_customize->add_section('pxt_ecommerce_lite_header_settings', array(
        'title' => __('Header', 'pxt-ecommerce'),
        'priority' => 122,
        'capability' => 'edit_theme_options',
        'panel' => 'panel_id',
    ));
    /* pagination */
    $wp_customize->add_section('pxt_ecommerce_lite_pagination_settings', array(
        'title' => __('Pagination Type', 'pxt-ecommerce'),
        'priority' => 122,
        'capability' => 'edit_theme_options',
        'panel' => 'panel_id',
    ));
    $wp_customize->add_setting('pxtBusinessPaginationType', array(
        'default' => '1',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_key',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'pxtBusinessPaginationType', array(
                'label' => __('Pagination Type', 'pxt-ecommerce'),
                'section' => 'pxt_ecommerce_lite_general_layoutno',
                'settings' => 'pxtBusinessPaginationType',
                'type' => 'radio',
                'choices' => array(
                    '0' => __('Next/Previous', 'pxt-ecommerce'),
                    '1' => __('Numbered', 'pxt-ecommerce'),
                ),
                'transport' => 'refresh',
            )
        )
    );

    /* Footer */
    $wp_customize->add_section('pxt_ecommerce_lite_footer_settings', array(
        'title' => __('Footer', 'pxt-ecommerce'),
        'priority' => 122,
        'capability' => 'edit_theme_options',
        'panel' => 'panel_id',
    ));

    $wp_customize->add_setting('pxt_ecommerce_lite_copyright_text', array(
        'default' => __('Copyright 2017 - Powered By WordPress', 'pxt-ecommerce'),
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'wp_kses',
    ));
    $wp_customize->add_control('pxt_ecommerce_lite_copyright_text', array(
        'label' => __('Copyright Text', 'pxt-ecommerce'),
        'description' => __('You can write your copyright own text or leave it blank.', 'pxt-ecommerce'),
        'section' => 'pxt_ecommerce_lite_footer_settingsno',
        'settings' => 'pxt_ecommerce_lite_copyright_text',
        'type' => 'textarea',
    ));
    // Text Input    
    $wp_customize->add_section('pxt_ecommerce_single_settings', array(
        'title' => __('Single Post Settings', 'pxt-ecommerce'),
        'priority' => 100,
        'capability' => 'edit_theme_options',
        'panel' => 'panel_id',
    ));
    //Breadcrumb
    $wp_customize->add_setting('pxt_ecommerce_lite_single_breadcrumb_section', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_key',
        'transport' => 'refresh',
        'default' => '1',
    ));
    $wp_customize->add_control('pxt_ecommerce_lite_single_breadcrumb_section', array(
        'label' => __('Breadcrumb Section', 'pxt-ecommerce'),
        'section' => 'pxt_ecommerce_single_settingsno',
        'settings' => 'pxt_ecommerce_lite_single_breadcrumb_section',
        'type' => 'radio',
        'choices' => array(
            '0' => __('OFF', 'pxt-ecommerce'),
            '1' => __('ON', 'pxt-ecommerce'),
        ),
    ));
    //Tags
    $wp_customize->add_setting('pxt_ecommerce_lite_single_tags_section', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_key',
        'transport' => 'refresh',
        'default' => '1',
    ));
    $wp_customize->add_control('pxt_ecommerce_lite_single_tags_section', array(
        'label' => __('Tags Section', 'pxt-ecommerce'),
        'section' => 'pxt_ecommerce_single_settingsno',
        'settings' => 'pxt_ecommerce_lite_single_tags_section',
        'type' => 'radio',
        'choices' => array(
            '0' => __('OFF', 'pxt-ecommerce'),
            '1' => __('ON', 'pxt-ecommerce'),
        ),
    ));
    //Related Posts
    $wp_customize->add_setting('pxt_ecommerce_lite_relatedposts_section', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_key',
        'transport' => 'refresh',
        'default' => '1',
    ));
    $wp_customize->add_control('pxt_ecommerce_lite_relatedposts_section', array(
        'label' => __('Related Posts Section', 'pxt-ecommerce'),
        'section' => 'pxt_ecommerce_single_settingsno',
        'settings' => 'pxt_ecommerce_lite_relatedposts_section',
        'type' => 'radio',
        'choices' => array(
            '0' => __('OFF', 'pxt-ecommerce'),
            '1' => __('ON', 'pxt-ecommerce'),
        ),
    ));
    //Author Box
    $wp_customize->add_setting('pxt_ecommerce_lite_authorbox_section', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_key',
        'transport' => 'refresh',
        'default' => '1',
    ));
    $wp_customize->add_control('pxt_ecommerce_lite_authorbox_section', array(
        'label' => __('Author box Section', 'pxt-ecommerce'),
        'section' => 'pxt_ecommerce_single_settingsno',
        'settings' => 'pxt_ecommerce_lite_authorbox_section',
        'type' => 'radio',
        'choices' => array(
            '0' => __('OFF', 'pxt-ecommerce'),
            '1' => __('ON', 'pxt-ecommerce'),
        ),
    ));
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
}
add_action('customize_register', 'pxt_ecommerce_CustomizeRegister');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pxt_ecommerce_CustomizePreviewJs() {
    wp_enqueue_script('pxt-ecommerce-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'pxt_ecommerce_CustomizePreviewJs');
