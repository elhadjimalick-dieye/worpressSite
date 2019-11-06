<?php
/**
 * Paradox Business theme functions and definitions.
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package pxt-ecommerce
 */

function pxt_ecommerce_ContentWidth() {
    $GLOBALS['content_width'] = apply_filters('pxt_ecommerce_ContentWidth', 678);
}

add_action('after_setup_theme', 'pxt_ecommerce_ContentWidth', 0);

if (!function_exists('pxt_ecommerce_Setup')) {

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function pxt_ecommerce_Setup() {
        define('PXT_ECOMMERCE_THEME_VERSION', '1.8');
        /**
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         */
        load_theme_textdomain('pxt-ecommerce', get_template_directory() . '/languages');
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');
        /**
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');
        /**
         * Enable support for Post Thumbnails on posts and pages.
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(150, 150, true);
        add_image_size('pxt-ecommerce-related', 200, 125, true); //related
        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary', 'pxt-ecommerce'),
        ));
        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         * Ref URL : https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
         */
        add_theme_support('html5', array(
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));
        if (pxt_ecommerce_isWcActive()) {
            add_theme_support('woocommerce');
        }else if(is_admin()){
            //pxt_ecommerce_error_notice(__('Please install / activate the WooCommerce Plugin.', 'pxt-ecommerce'), esc_attr('error'));
        }
        // thumbnail_image_width and single_image_width will set the image sizes for the shop
        add_theme_support( 'woocommerce', array(
            'thumbnail_image_width' => 250,
            'single_image_width'    => 300,

            // The 'product_grid' settings let theme developers set default, minimum, and maximum column and row settings for the Shop
            'product_grid'          => array(
                'default_rows'    => 3,
                'min_rows'        => 2,
                'max_rows'        => 8,
                'default_columns' => 4,
                'min_columns'     => 2,
                'max_columns'     => 5,
            ),
        ) );


        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('pxt_ecommerce_CustomBackgroundArgs', array(
            'default-color' => esc_attr('#fff'),
            'default-image' => '',
        )));
        /**
         * This theme styles the visual editor to resemble the theme style,
         * specifically font, colors, icons, and column width.
         */
        add_editor_style('css/editor-style.css');
    }

}
add_action('after_setup_theme', 'pxt_ecommerce_Setup');

/**
 * Register widget area.
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pxt_ecommerce_WidgetsInit() {
    register_sidebar(array(
        'name' => __('Sidebar', 'pxt-ecommerce'),
        'id' => 'sidebar',
        'description' => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    // First Footer 
    register_sidebar(array(
        'name' => __('Footer 1', 'pxt-ecommerce'),
        'description' => __('First footer column', 'pxt-ecommerce'),
        'id' => 'footer-first',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    // Second Footer 
    register_sidebar(array(
        'name' => __('Footer 2', 'pxt-ecommerce'),
        'description' => __('Second footer column', 'pxt-ecommerce'),
        'id' => 'footer-second',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    // Third Footer 
    register_sidebar(array(
        'name' => __('Footer 3', 'pxt-ecommerce'),
        'description' => __('Third footer column', 'pxt-ecommerce'),
        'id' => 'footer-third',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    if (pxt_ecommerce_isWcActive()) {
        // Register WooCommerce Shop and Single Product Sidebar
        register_sidebar(array(
            'name' => __('Shop Page Sidebar', 'pxt-ecommerce'),
            'description' => __('Appears on Shop main page and product archive pages.', 'pxt-ecommerce'),
            'id' => 'shop-sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
        register_sidebar(array(
            'name' => __('Single Product Sidebar', 'pxt-ecommerce'),
            'description' => __('Appears on single product pages.', 'pxt-ecommerce'),
            'id' => 'product-sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
    }
}

add_action('widgets_init', 'pxt_ecommerce_WidgetsInit');

function pxt_ecommerce_CustomSidebar() {
    // Default sidebar.
    $pxt_ecommerce_sidebar = 'sidebar';
    // Woocommerce.
    if (pxt_ecommerce_isWcActive()) {
        if (is_shop() || is_product_category()) {
            $pxt_ecommerce_sidebar = 'shop-sidebar';
        }
        if (is_product()) {
            $pxt_ecommerce_sidebar = 'product-sidebar';
        }
    }
    return $pxt_ecommerce_sidebar;
}

// Enqueue scripts and styles.
function pxt_ecommerce_Scripts() {
    $pxt_ecommerce_handle = 'pxt_style';
    // WooCommerce
    if (pxt_ecommerce_isWcActive()) {
        if (is_woocommerce() || is_cart() || is_checkout()) {
            wp_enqueue_style('pxt_ecommerce_woocommerce', get_template_directory_uri() . '/css/woocommerce2.css');
            $pxt_ecommerce_handle = 'pxt_woocommerce';
        }
    }
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');    
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
	wp_enqueue_style('pxt_ecommerce_style', get_stylesheet_uri());
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'), '', true);
    wp_enqueue_script('pxt_customscripts', get_template_directory_uri() . '/js/customscripts.js', array('jquery'), '', true);
    
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    $pxt_ecommerce_ColorScheme2 = get_theme_mod('pxtEcommerceColorScheme2', '#0088cc');
    $pxt_ecommerce_Layout = get_theme_mod('pxtEcommerceLayout', 'cslayout');
    $pxt_ecommerce_ColorScheme = get_theme_mod('pxtEcommerceColorScheme', '#0088cc');
    $top_header_background_color = get_theme_mod('top_header_background_color', '#fff');
    $pxt_ecommerce_header_text_color = get_header_textcolor();
    $pxt_ecommerce_header_image = get_header_image();

    $pxt_ecommerce_custom_css = '#site-header, header.header { background-image: url('.esc_url($pxt_ecommerce_header_image).'); }
    #tabber .inside li .meta b,footer .widget li a:hover,.fn a,.reply a, a:hover, .sidebar.c-4-12 .textwidget a,#tabber .inside li div.info .entry-title a:hover, .top a:hover, footer .tagcloud a:hover, #navigation ul ul a:hover,.single_post a, #site-footer .textwidget a, #commentform a, #tabber .inside li a, .copyrights a:hover, a, .sidebar.c-4-12 a:hover { color: '.esc_attr($pxt_ecommerce_ColorScheme).'; }
    .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li a:hover, .woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce-page nav.woocommerce-pagination ul li a:focus, .woocommerce #content nav.woocommerce-pagination ul li a:focus, .woocommerce-page #content nav.woocommerce-pagination ul li a:focus, .pagination .current, .tagcloud a { border-color: '.esc_attr($pxt_ecommerce_ColorScheme).'; }
    span.sticky-post, .nav-previous a:hover, .nav-next a:hover, #commentform input#submit, #searchform input[type="submit"], .home_menu_item, .pagination a:hover, .readMore a, .pxtt-subscribe input[type="submit"], .pagination .current, .primary-navigation, .currenttext, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce-page a.button, .woocommerce button.button, .woocommerce-product-search input[type=\"submit\"], .woocommerce a.button, .woocommerce-page button.button, .woocommerce input.button, .woocommerce-page input.button, .woocommerce #respond input#submit, .woocommerce-page #respond input#submit, .woocommerce #content input.button, .woocommerce-page #content input.button { background-color: '.esc_attr($pxt_ecommerce_ColorScheme).'; }
    .corner { border-color: transparent transparent '.esc_attr($pxt_ecommerce_ColorScheme).' transparent;}
    .primary-navigation, footer, .readMore a:hover, #commentform input#submit:hover, .featured-thumbnail .latestPost-review-wrapper { background-color: '.esc_attr($pxt_ecommerce_ColorScheme2).'; }
    .header{ background: '.esc_attr($top_header_background_color).';}';
  $pxt_ecommerce_custom_css .= '#site-header { background-color:'.esc_attr($top_header_background_color).' }
   .pxt-cart-contents:before{
        color: #'.esc_attr($pxt_ecommerce_header_text_color ).';
    }
    #sidebars .widget{
        background-color:'.esc_attr( $pxt_ecommerce_ColorScheme2 ).'1a;
    }
    .woocommerce-Price-amount{
        color:'.esc_attr($pxt_ecommerce_ColorScheme2 ).';
    }
    .post.excerpt{
        border-color:'.esc_attr($pxt_ecommerce_ColorScheme2).'b3;
    }
    .navbar-collapse,#site-header, header.header,#site-footer,.pagination .current,.sub-menu,.woocommerce-pagination li span{
        background-color:'.esc_attr($pxt_ecommerce_ColorScheme).' !important;
    }
    .widget h3{
        background-color:'.esc_attr($pxt_ecommerce_ColorScheme).';
    }
    span.sticky-post{
       background-color:'.esc_attr($pxt_ecommerce_ColorScheme2).'; 
    }
   .readMore a{
    background:'.esc_attr($pxt_ecommerce_ColorScheme2).'; 
    }
    .toggle-bar{
        background:'.esc_attr($pxt_ecommerce_ColorScheme).'; 
    }
   ';
  
    if (!empty($pxt_ecommerce_Layout) && $pxt_ecommerce_Layout == "sclayout") {
        $pxt_ecommerce_custom_css .= ".article { float: right; } .sidebar.c-4-12 { float: left; }";
    }
    wp_register_style( $pxt_ecommerce_handle, false );
    wp_enqueue_style( $pxt_ecommerce_handle );
    wp_add_inline_style($pxt_ecommerce_handle, esc_attr($pxt_ecommerce_custom_css));
}

add_action('wp_enqueue_scripts', 'pxt_ecommerce_Scripts');
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/pxt-customizer.php';
require get_template_directory() . '/inc/jetpack.php';
require get_template_directory() . '/inc/install-plugin.php';
include_once( get_template_directory()."/widget/socialMediaIcons.php" );

// Custom Comments template
if (!function_exists('pxt_ecommerce_Comments')) {

    function pxt_ecommerce_Comment($pxt_ecommerce_comment, $pxt_ecommerce_args, $pxt_ecommerce_depth) {
        ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
            <div id="comment-<?php comment_ID(); ?>" class="posRelative" itemscope itemtype="http://schema.org/UserComments">
                <div class="comment-author vcard">
                    <?php echo get_avatar($pxt_ecommerce_comment->comment_author_email, 70); ?>
                    <div class="comment-metadata">
                        <?php printf('<span class="fn" itemprop="creator" itemscope itemtype="http://schema.org/Person">%s</span>', get_comment_author_link()) ?>
                        <span class="comment-meta">
                            <?php edit_comment_link(__('(Edit)', 'pxt-ecommerce'), '  ', '') ?>
                        </span>
                    </div>
                </div>
                <?php if ($pxt_ecommerce_comment->comment_approved == '0') { ?>
                    <em><?php __('Your comment is awaiting moderation.', 'pxt-ecommerce') ?></em>
                    <br />
                <?php } ?>
                <div class="commentmetadata" itemprop="commentText">
                    <?php comment_text() ?>
                    <time><?php comment_date(get_option('date_format')); ?></time>
                    <span class="reply">
                        <?php comment_reply_link(array_merge($pxt_ecommerce_args, array('depth' => $pxt_ecommerce_depth, 'max_depth' => $pxt_ecommerce_args['max_depth']))) ?>
                    </span>
                </div>
            </div>
        </li>
        <?php
    }

}

// get an excerpt for an article/page
function pxt_ecommerce_Excerpt($pxt_ecommerce_limit) {
    $pxt_ecommerce_excerpt = explode(' ', get_the_excerpt(), $pxt_ecommerce_limit);
    if (count($pxt_ecommerce_excerpt) >= $pxt_ecommerce_limit) {
        array_pop($pxt_ecommerce_excerpt);
        $pxt_ecommerce_excerpt = implode(" ", $pxt_ecommerce_excerpt);
    } else {
        $pxt_ecommerce_excerpt = implode(" ", $pxt_ecommerce_excerpt);
    }
    $pxt_ecommerce_excerpt = preg_replace('`[[^]]*]`', '', $pxt_ecommerce_excerpt);
    return $pxt_ecommerce_excerpt;
}

/**
 * Shorthand function to check for more tag in post.
 * @return bool|int
 */
function pxt_ecommerce_PostHasMoretag() {
    return strpos(get_the_content(), '<!--more-->');
}

if (!function_exists('pxt_ecommerce_Readmore')) {

    // Display a "read more" link.
    function pxt_ecommerce_Readmore() {
        ?>
        <div class="readMore">
            <a href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php the_title_attribute(); ?>">
                <?php esc_html_e('Read More', 'pxt-ecommerce'); ?>
            </a>
        </div>
        <?php
    }

}

// Manageing the Breadcrumbs
if (!function_exists('pxt_ecommerce_Breadcrumb')) {

    function pxt_ecommerce_Breadcrumb() {
        if (is_front_page()) {
            return;
        }
        echo '<span typeof="v:Breadcrumb" class="root"><a rel="v:url" property="v:title" href="';
        echo esc_url(home_url());
        echo '">' . esc_html(sprintf(__("Home", 'pxt-ecommerce')));
        echo '</a></span><span><i class="paradox-icon icon-angle-double-right"></i></span>';
        if (is_single()) {
            $pxt_ecommerce_categories = get_the_category();
            if ($pxt_ecommerce_categories) {
                $pxt_ecommerce_level = 0;
                $pxt_ecommerce_hierarchy_arr = array();
                foreach ($pxt_ecommerce_categories as $pxt_ecommerce_cat) {
                    $pxt_ecommerce_anc = get_ancestors($pxt_ecommerce_cat->term_id, 'category');
                    $pxt_ecommerce_count_anc = count($pxt_ecommerce_anc);
                    if (0 < $pxt_ecommerce_count_anc && $pxt_ecommerce_level < $pxt_ecommerce_count_anc) {
                        $pxt_ecommerce_level = $pxt_ecommerce_count_anc;
                        $pxt_ecommerce_hierarchy_arr = array_reverse($pxt_ecommerce_anc);
                        array_push($pxt_ecommerce_hierarchy_arr, $pxt_ecommerce_cat->term_id);
                    }
                }
                if (empty($pxt_ecommerce_hierarchy_arr)) {
                    $pxt_ecommerce_category = $pxt_ecommerce_categories[0];
                    echo '<span typeof="v:Breadcrumb"><a href="' . esc_url(get_category_link($pxt_ecommerce_category->term_id)) . '" rel="v:url" property="v:title">' . esc_html($pxt_ecommerce_category->name) . '</a></span><span><i class="paradox-icon icon-angle-double-right"></i></span>';
                } else {
                    foreach ($pxt_ecommerce_hierarchy_arr as $pxt_ecommerce_cat_id) {
                        $pxt_ecommerce_category = get_term_by('id', $pxt_ecommerce_cat_id, 'category');
                        echo '<span typeof="v:Breadcrumb"><a href="' . esc_url(get_category_link($pxt_ecommerce_category->term_id)) . '" rel="v:url" property="v:title">' . esc_html($pxt_ecommerce_category->name) . '</a></span><span><i class="paradox-icon icon-angle-double-right"></i></span>';
                    }
                }
            }
            echo "<span><span>";
            the_title();
            echo "</span></span>";
        } elseif (is_page()) {
            $pxt_ecommerce_parent_id = wp_get_post_parent_id(get_the_ID());
            if ($pxt_ecommerce_parent_id) {
                $pxt_ecommerce_breadcrumbs = array();
                while ($pxt_ecommerce_parent_id) {
                    $pxt_ecommerce_page = get_page($pxt_ecommerce_parent_id);
                    $pxt_ecommerce_breadcrumbs[] = '<span typeof="v:Breadcrumb"><a href="' . esc_url(get_permalink($pxt_ecommerce_page->ID)) . '" rel="v:url" property="v:title">' . esc_html(get_the_title($pxt_ecommerce_page->ID)) . '</a></span><span><i class="paradox-icon icon-angle-double-right"></i></span>';
                    $pxt_ecommerce_parent_id = $pxt_ecommerce_page->post_parent;
                }
                $pxt_ecommerce_breadcrumbs = array_reverse($pxt_ecommerce_breadcrumbs);
                foreach ($pxt_ecommerce_breadcrumbs as $pxt_ecommerce_crumb) {
                    echo esc_html($pxt_ecommerce_crumb);
                }
            }
            echo "<span><span>";
            the_title();
            echo "</span></span>";
        } elseif (is_category()) {
            global $wp_query;
            $pxt_ecommerce_cat_obj = $wp_query->get_queried_object();
            $this_cat_id = $pxt_ecommerce_cat_obj->term_id;
            $pxt_ecommerce_hierarchy_arr = get_ancestors($this_cat_id, 'category');
            if ($pxt_ecommerce_hierarchy_arr) {
                $pxt_ecommerce_hierarchy_arr = array_reverse($pxt_ecommerce_hierarchy_arr);
                foreach ($pxt_ecommerce_hierarchy_arr as $pxt_ecommerce_cat_id) {
                    $pxt_ecommerce_category = get_term_by('id', $pxt_ecommerce_cat_id, 'category');
                    echo '<span typeof="v:Breadcrumb"><a href="' . esc_url(get_category_link($pxt_ecommerce_category->term_id)) . '" rel="v:url" property="v:title">' . esc_html($pxt_ecommerce_category->name) . '</a></span><span><i class="paradox-icon icon-angle-double-right"></i></span>';
                }
            }
            echo "<span><span>";
            single_cat_title();
            echo "</span></span>";
        } elseif (is_author()) {
            echo "<span><span>";
            if (get_query_var('author_name')) :
                $pxt_ecommerce_curauth = get_user_by('slug', get_query_var('author_name'));
            else :
                $pxt_ecommerce_curauth = get_userdata(get_query_var('author'));
            endif;
            echo esc_html($pxt_ecommerce_curauth->nickname);
            echo "</span></span>";
        } elseif (is_search()) {
            echo "<span><span>";
            the_search_query();
            echo "</span></span>";
        } elseif (is_tag()) {
            echo "<span><span>";
            single_tag_title();
            echo "</span></span>";
        }
    }

}

/**
 * WP Mega Menu Plugin Support
 */
function pxt_ecommerce_MegamenuParentElement($selector) {
    return '.primary-navigation .container';
}

add_filter('wpmm_container_selector', 'pxt_ecommerce_MegamenuParentElement');

/**
 * Determines whether the WooCommerce plugin is active or not.
 * @return bool
 */
function pxt_ecommerce_isWcActive() {
    if (is_multisite()) {
        
        return is_plugin_active('woocommerce/woocommerce.php');
    } else {
        return in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')));
    }
}

// WooCommerce
if (pxt_ecommerce_isWcActive()) {
    if (!function_exists('pxt_ecommerce_LoopColumns')) {

        /**
         * Change number or products per row to 3
         * @return int
         */
        function pxt_ecommerce_LoopColumns() {
            return 3; // 3 products per row
        }

    }
    add_filter('loop_shop_columns', 'pxt_ecommerce_LoopColumns');

    /**
     * Redefine woocommerce_output_related_products()
     */
    function woocommerce_output_related_products() {
        $pxt_ecommerce_args = array('posts_per_page' => 3, 'columns' => 3);
        woocommerce_related_products($pxt_ecommerce_args); // Display 3 products in rows of 1
    }
    

    /**
     * Change the number of product thumbnails to show per row to 4.
     * @return int
     */
    function pxt_ecommerce_WoocommerceThumbCols() {
        return 4; // .last class applied to every 4th thumbnail
    }

    add_filter('woocommerce_product_thumbnails_columns', 'pxt_ecommerce_WoocommerceThumbCols');

    /**
     * Ensure cart contents update when products are added to the cart via AJAX.
     * @param $pxt_ecommerce_fragments
     * @return mixed
     */
    function pxt_ecommerce_HeaderAddToCartFragment($pxt_ecommerce_fragments) {
        global $woocommerce;
        ob_start();
        ?>  
        <a class="cart-contents" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" title="<?php esc_attr__('View your shopping cart', 'pxt-ecommerce'); ?>">
            <?php echo esc_html(sprintf(_n('%d item', '%d items', esc_html($woocommerce->cart->cart_contents_count), 'pxt-ecommerce'), esc_html($woocommerce->cart->cart_contents_count))); ?> - <?php echo esc_html($woocommerce->cart->get_cart_total()); ?>
        </a>
        <?php
        $pxt_ecommerce_fragments['a.cart-contents'] = ob_get_clean();
        return $pxt_ecommerce_fragments;
    }

    add_filter('add_to_cart_fragments', 'pxt_ecommerce_HeaderAddToCartFragment');

    /**
     * Optimize WooCommerce Scripts
     * Updated for WooCommerce 2.0+
     * Remove WooCommerce Generator tag, styles, and scripts from non WooCommerce pages.
     */
    function pxt_ecommerce_ManageWoocommerceStyles() {
        //remove generator meta tag
        remove_action('wp_head', array($GLOBALS['woocommerce'], 'generator'));
        //first check that woo exists to prevent fatal errors
        if (function_exists('is_woocommerce')) {
            //dequeue scripts and styles
            if (!is_woocommerce() && !is_cart() && !is_checkout()) {
                wp_dequeue_style('woocommerce-layout');
                wp_dequeue_style('woocommerce-smallscreen');
                wp_dequeue_style('woocommerce-general');
                wp_dequeue_style('wc-bto-styles'); //Composites Styles
                wp_dequeue_script('wc-add-to-cart');
                wp_dequeue_script('wc-cart-fragments');
                wp_dequeue_script('woocommerce');
                wp_dequeue_script('jquery-blockui');
                wp_dequeue_script('jquery-placeholder');
            }
        }
    }

    add_action('wp_enqueue_scripts', 'pxt_ecommerce_ManageWoocommerceStyles', 99);
    // Remove WooCommerce generator tag.
    remove_action('wp_head', 'wc_generator_tag');
}

// Post Layout for Archives
if (!function_exists('pxt_ecommerce_ArchivePost')) {

    /**
     * Display a post of specific layout.
     * @param string $layout
     */
    function pxt_ecommerce_ArchivePost($layout = '') {
        $pxt_ecommerce_lite_full_posts = esc_html(get_theme_mod('pxt_ecommerce_lite_full_posts', '0'));
        ?>
        <article class="post excerpt">
            <?php
            if (is_sticky() && is_home() && !is_paged()) {
                printf(wp_kses('<span class="sticky-post">%s</span>', array('span'=>array('class'=>array()))), esc_html(__('Featured', 'pxt-ecommerce')));
            }
            ?>   
            <?php if (is_single()) : ?>
                <div class="post-date-paradox"><?php the_time(get_option('date_format')); ?></div>
            <?php endif; ?>
            <header>
                <h2 class="title">
                    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
                </h2>
            </header><!--.header-->
            <?php if (empty($pxt_ecommerce_lite_full_posts)) : ?>
                <?php if (has_post_thumbnail()) { ?>
                    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" id="featured-thumbnail">
                        <div class="featured-thumbnail">
                            <?php the_post_thumbnail('pxt-ecommerce-featured', array('title' => '')); ?>
                            <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
                        </div>
                    </a>
                <?php } else { ?>
                <?php } ?>
                <div class="post-content">
                    <?php echo esc_html(pxt_ecommerce_Excerpt(56)); ?>
                </div>
                <?php pxt_ecommerce_Readmore(); ?>
            <?php else : ?>
                <div class="post-content full-post">
                    <?php the_content(); ?>
                </div>
                <?php if (pxt_ecommerce_PostHasMoretag()) : ?>
                    <?php pxt_ecommerce_Readmore(); ?>
                <?php endif; ?>
            <?php endif; ?>
        </article>
        <?php
    }

}

function pxt_ecommerce_LoadCustomAdminStyle($hook) {
    if ('appearance_page_about-pxtBusiness' !== $hook) {
        return;
    }
    wp_enqueue_style('pxt-ecommerce-custom-admin-css', get_template_directory_uri() . '/css/themeinfo.css', false, '1.0.0');
}

add_action('customize_controls_print_styles', 'pxt_ecommerce_CustomizerStylesheet');
add_action('admin_enqueue_scripts', 'pxt_ecommerce_LoadCustomAdminStyle');

/**
 * 
 * @param string $message a message that is to be shown
 * @param string $type a message type defult is 'update' possible values are 'error' and 'update-nag'
 *
 * @reference URL: 
 *   https://codex.wordpress.org/Plugin_API/Action_Reference/admin_notices
 *   https://premium.wpmudev.org/blog/adding-admin-notices/  
 **/
function pxt_ecommerce_error_notice($message, $type='update', $dismiss = false) {
    ?>
    <div class="<?php echo esc_html($type);?> notice  <?php if($dismiss === true){?>is-dismissible<?php }?>">
        <p><strong><?php echo esc_html($message);?></strong></p>
        <?php if($dismiss === true){?>
            <button type="button" class="notice-dismiss"><span class="screen-reader-text"><?php __('Dismiss this notice.','pxt-ecommerce');?></span></button>
        <?php }?>
    </div>
    <?php
}
/**
 * Add Cart icon and count to header if WC is active
 */
function pxt_ecommerce_wc_cart_count() {
 
    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

        global $woocommerce;

        $count = $woocommerce->cart->cart_contents_count;
        ?><a class="pxt-cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php __( 'View your shopping cart','pxt-ecommerce' ); ?>"><?php
        if ( $count > 0 ) {
            ?>
            <span class="pxt-cart-contents-count"><?php echo esc_html( $count ); ?></span>
            <?php
        }
                ?></a><?php
    }
 
}

