<?php
/**
 * The template for displaying search result page.
 * @package pxt-ecommerce
 */
get_header();
?>
<div id="primary" class="content-area">
    <div class="row">
        <div class="col-md-8 col-xm-12">
            <div id="content" class="article1">
                <?php
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        pxt_ecommerce_ArchivePost();
                    }
                    pxt_ecommerce_PostNavigation();
                } else {
                    ?>
                    <div class="single_post clear">
                        <article id="content" class="article page">
                            <header>
                                <h1 class="title"><?php esc_html_e('No Records Found', 'pxt-ecommerce'); ?></h1>
                            </header>
                            <div class="alert alert-warning"><?php esc_html_e('Sorry, but no match found for your search terms. Please try again with some different keywords.', 'pxt-ecommerce'); ?></div>
                            <?php get_search_form(); ?>
                        </article>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
