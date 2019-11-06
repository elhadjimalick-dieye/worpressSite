<?php
/**
 * The template for display all single posts.
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 * @package pxt-ecommerce
 */
$pxt_ecommerce_SingleBreadcrumbSection = get_theme_mod('pxt_ecommerce_lite_single_breadcrumb_section', '1');
$pxt_ecommerce_SingleTagsSection = get_theme_mod('pxt_ecommerce_lite_single_tags_section', '1');
$pxt_ecommerce_AuthorboxSection = get_theme_mod('pxt_ecommerce_lite_authorbox_section', '1');
$pxt_ecommerce_RelatedpostsSection = get_theme_mod('pxt_ecommerce_lite_relatedposts_section', '1');
get_header();
?>
<div id="primary" class="content-area">
    <div class="row">
        <div class="col-md-8 col-xm-12">
            <!-- Start Article -->
            <?php if ($pxt_ecommerce_SingleBreadcrumbSection == '1') { ?>
                <div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#"><?php pxt_ecommerce_Breadcrumb(); ?></div>
            <?php } ?>
            <article class="article1">

                <?php if (have_posts()) while (have_posts()) : the_post(); ?>
                        <div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
                            <div class="single_post">
                                <header>
                                    <div class="post-date-paradox"><?php the_time(esc_html(get_option('date_format'))); ?></div>
                                    <!-- Start Title -->
                                    <h1 class="title single-title"><?php the_title(); ?></h1>
                                    <!-- End Title -->
                                </header>
                                <!-- Start Content -->
                                <div id="content" class="post-single-content box mark-links">
                                    <?php the_content(); ?>
                                    <?php if ($pxt_ecommerce_SingleTagsSection == '1') { ?>
                                        <!-- Start Tags -->
                                        <div class="tags">
                                            <?php $tag = '<span class="tag-text">' . esc_html_e('Tags', 'pxt-ecommerce') . ':</span>';?>
                                            <?php the_tags($tag, ' | ') ?>
                                        </div>
                                        <!-- End Tags -->
                                    <?php } ?>
                                </div><!-- End Content -->
                                <?php 
                                    $defaults = array(
                                        'nextpagelink'     => __( 'Next page', 'pxt-ecommerce' ),
                                        'previouspagelink' => __( 'Previous page', 'pxt-ecommerce' ),
                                    );
                                    echo wp_link_pages($defaults);?>
                                <?php if ($pxt_ecommerce_RelatedpostsSection == '1') { ?>	
                                    <!-- Start Related Posts -->
                                    <?php
                                    $pxt_ecommerce_categories = get_the_category($post->ID);
                                    if ($pxt_ecommerce_categories) {
                                        $pxt_ecommerce_category_ids = array();
                                        foreach ($pxt_ecommerce_categories as $pxt_ecommerce_individual_category)
                                            $pxt_ecommerce_category_ids[] = $pxt_ecommerce_individual_category->term_id;

                                        $args = array('category__in' => $pxt_ecommerce_category_ids,
                                            'post__not_in' => array($post->ID),
                                            'ignore_sticky_posts' => 1,
                                            'showposts' => 3,
                                            'orderby' => 'rand');
                                        $my_query = new wp_query($args);
                                        if ($my_query->have_posts()) {
                                            ?>
                                            <div class="related-posts"><div class="post-author-top"><h3>
                                                <?php __('Similar Posts', 'pxt-ecommerce');?>
                                            </h3></div>
                                            <?php
                                            $pexcerpt = 1;
                                            $j = 0;
                                            $counter = 0;
                                            while ($my_query->have_posts()) {
                                                $my_query->the_post();
                                                ?>
                                                <article class="post excerpt <?php echo ( ++$j % 3 == 0) ? 'last' : ''; ?>">
                                                    <?php if (has_post_thumbnail()) { ?>
                                                        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" id="featured-thumbnail">
                                                            <div class="featured-thumbnail">
                                                                <?php the_post_thumbnail('post-thumbnail', array('title' => '')); ?>
                                                                <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
                                                            </div>
                                                            <header>
                                                                <h4 class="title front-view-title"><?php the_title(); ?></h4>
                                                            </header>
                                                        </a>
                                                    <?php } else { ?>
                                                        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" id="featured-thumbnail">
                                                            <header>
                                                                <h4 class="title front-view-title"><?php the_title(); ?></h4>
                                                            </header>
                                                        </a>
                                                    <?php } ?>
                                                </article><!--.post.excerpt-->
                                                <?php $pexcerpt++; ?>
                                                <?php
                                            }
                                            echo '</div>';
                                        }
                                    }
                                    wp_reset_postdata();
                                    ?>
                                    <!-- End Related Posts -->
                                <?php } ?>  
                                <?php if ($pxt_ecommerce_AuthorboxSection == '1') { ?>
                                    <!-- Start Author Box -->
                                    <div class="post-author">
                                        <h4><?php esc_html_e('About The Author', 'pxt-ecommerce'); ?></h4>
                                        <?php
                                        // if (function_exists('get_avatar')) {
                                            echo get_avatar(esc_attr(get_the_author_meta('user_email'), '85'));
                                        // }
                                        ?>
                                        <h5><?php the_author(); ?></h5>
                                        <p><?php the_author_meta('description') ?></p>
                                    </div>
                                    <!-- End Author Box -->
                                <?php } ?>
                                <?php comments_template('', true); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
            </article>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
