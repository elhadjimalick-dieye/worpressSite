<?php
/**
 * The main template file
 * Used to display the homepage when home.php doesn't exist.
 * @link http://codex.wordpress.org/Template_Hierarchy
 */
?>
<?php get_header(); ?>
<div id="primary" class="content-area">
	<div class="row">
		<div class="container">
		<div class="col-md-8 col-xm-12">
			<?php if ( have_posts() ) {
				$pxt_ecommerce_lite_full_posts = get_theme_mod('pxt_ecommerce_lite_full_posts');
				while ( have_posts() ) {
					the_post();
					pxt_ecommerce_ArchivePost();
				}
				pxt_ecommerce_PostNavigation();
			} ?>
		</div>
		<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
