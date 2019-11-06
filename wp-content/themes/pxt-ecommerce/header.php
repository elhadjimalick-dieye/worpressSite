<?php
/**
 * The header for our theme.
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package pxt-ecommerce
 * @since pxt business 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div id="page-id">
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'pxt-ecommerce'); ?></a>
        <header class="header" id="#site-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <?php if (has_custom_logo()) { ?>
                            <?php if (is_front_page() || is_home() || is_404()) { ?>
                                <h1 id="logo" class="image-logo" itemprop="headline">
                                    <?php the_custom_logo(); ?>
                                </h1>
                            <?php } else { ?>
                                <h2 id="logo" class="image-logo" itemprop="headline">
                                    <?php the_custom_logo(); ?>
                                </h2>
                            <?php } ?>
                        <?php } else { ?>
                            <?php if (is_front_page() || is_home() || is_404()) { ?>
                                <h1 id="logo" class="site-title" itemprop="headline">
                                    <a href="<?php echo esc_url(home_url()); ?>"><?php bloginfo('name'); ?></a>
                                </h1>
                                <div class="site-description"><?php bloginfo('description'); ?></div>
                            <?php } else { ?>
                                <h2 id="logo" class="site-title" itemprop="headline">
                                    <a href="<?php echo esc_url(home_url()); ?>"><?php bloginfo('name'); ?></a>
                                </h2>
                                <div class="site-description"><?php bloginfo('description'); ?></div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col-md-8 no-padding no-margin">
                        <div class="row">
                         <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                            <span class="sr-only"><?php esc_html_e('Toggle navigation', 'pxt-ecommerce');?></span>
                        </a>
                        <div id="navbar" class="navbar-collapse">
                            <nav id="ht-site-navigation" class="ht-main-navigation">
                                <div class="toggle-bar"><span></span></div>
                                <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'primary',
                                    'container_class' => 'ht-menu ht-clearfix',
                                    'menu_class' => 'ht-clearfix',
                                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                ));//current-menu-item
                                ?>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 text-right">
                    <ul class="header-top-left">
                        <li> <?php pxt_ecommerce_wc_cart_count() ?></li>
                    </ul>  
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                </div>
            </div>
        </div>
    </header>
