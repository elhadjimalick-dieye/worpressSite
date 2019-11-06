</div>
<footer id="site-footer" role="contentinfo">
    <div class="container">
        <?php if (is_active_sidebar('footer-first') || is_active_sidebar('footer-second') || is_active_sidebar('footer-third')) { ?>
            <div class="row">
                <div class="col-md-4">
                    <?php if (is_active_sidebar('footer-first')) : ?>
                        <?php dynamic_sidebar('footer-first'); ?>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <?php if (is_active_sidebar('footer-second')) : ?>
                        <?php dynamic_sidebar('footer-second'); ?>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <?php if (is_active_sidebar('footer-third')) : ?>
                        <?php dynamic_sidebar('footer-third'); ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php } ?>
        <!-- start site copyrights -->
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <?php $pxt_ecommerce_year = date_i18n(__('Y', 'pxt-ecommerce'));?>
                    <?php echo '&copy; ' . esc_html($pxt_ecommerce_year);  ?> <?php bloginfo('name'); ?>
                    <span class="scroll-to-top">
                        <a href="#top" class="toplink" title="<?php esc_attr__('Back to Top', 'pxt-ecommerce'); ?>"><?php esc_html_e('Back to Top', 'pxt-ecommerce'); ?> &uarr;</a>
                    </span>
                </div>
            </div>
        </div>
        <!--end copyrights-->
    </div>
</footer><!-- #site-footer -->

<?php wp_footer(); ?>
</div>
</body>
</html>
