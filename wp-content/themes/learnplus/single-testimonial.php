<?php
/**
 * The Template for displaying all single posts.
 *
 * @package LearnPlus
 */

get_header(); ?>

<div id="primary" class="content-area <?php learnplus_content_columns() ?>">
	<main id="main" class="site-main">
		<?php do_action( 'learnplus_page_title' ); ?>

		<?php
		while ( have_posts() ) : the_post();
				get_template_part( 'parts/content', 'single' );
			// If comments are open or we have at least one comment, load up the comment template
			if ( ( comments_open() || get_comments_number() ) ) {
				comments_template();
			}
		endwhile; // end of the loop.
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
