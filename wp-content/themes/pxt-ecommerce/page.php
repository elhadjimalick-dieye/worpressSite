<?php
/**
 * The template for displaying all pages.
 * This is the template that displays all pages by default. 
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package pxt-ecommerce
 */
get_header();
?>
<div id="primary" class="content-area">
    <div class="row">
	<div class="container">
        <div class="col-md-8 col-xm-12 padding0">
            <article class="article">
                <div id="content_box" >
                    <?php
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                            ?>
                            <div id="post-<?php the_ID(); ?>" <?php post_class('g post'); ?>>
                                <div class="single_page single_post clear">
                                    <header>
                                        <h1 class="title"><?php the_title(); ?></h1>
                                    </header>
                                    <div id="content" class="post-single-content box mark-links">
                                        <?php the_content(); ?>                                    
                                    </div>
                                    <?php comments_template('', true); ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </article>
            <section>
                <?php
                $defaults = array(
                    'before'           => '<div>' . __( 'Pages:', 'pxt-ecommerce' ),
                    'after'            => '</div>',
                    'link_before'      => '',
                    'link_after'       => '',
                    'next_or_number'   => 'number',
                    'separator'        => ' | ',
                    'nextpagelink'     => __( 'Next page', 'pxt-ecommerce' ),
                    'previouspagelink' => __( 'Previous page', 'pxt-ecommerce' ),
                    'pagelink'         => '%',
                    'echo'             => 1
                );
                wp_link_pages( $defaults );
                ?>
            </section>
        </div>
        <?php get_sidebar(); ?>
		</div>
    </div>
</div>
<?php get_footer(); ?>
