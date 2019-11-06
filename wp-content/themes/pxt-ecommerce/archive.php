<?php
/**
 * The template for displaying archive pages.
 * Used for displaying archive-type pages. These views can be further customized by
 * creating a separate template for each one.
 * - author.php (Author archive)
 * - category.php (Category archive)
 * - date.php (Date archive)
 * - tag.php (Tag archive)
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
?>
<?php get_header(); ?>
<div id="primary" class="content-area">
    <div class="row">
        <div class="col-md-8 col-xm-12">
            <h1 class="postsby">
                <span><?php the_archive_title(); ?></span>
            </h1>	
            <?php
            if (have_posts()) :
                $pxt_ecommerce_lite_full_posts = esc_html(get_theme_mod('pxt_ecommerce_lite_full_posts'));
                while (have_posts()) : the_post();
                    pxt_ecommerce_ArchivePost();
                endwhile;
                pxt_ecommerce_PostNavigation();
            endif;
            ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>