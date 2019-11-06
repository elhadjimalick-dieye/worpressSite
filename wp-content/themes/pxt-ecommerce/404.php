<?php get_header(); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-xm-12">
                <div class="single_post">
                    <h1 class="title text-center"><?php esc_html_e('Error 404 Page Not Found', 'pxt-ecommerce'); ?></h1>
                    <div class="post-content text-center">
                        <p><?php esc_html_e('Oops! You Requested the page is no longer available.', 'pxt-ecommerce'); ?></p>
                        <p><?php esc_html_e('Please check the URL you entered or use the search form below', 'pxt-ecommerce'); ?></p>
                        <?php get_search_form(); ?>
                    </div>
                </div>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>