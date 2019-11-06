<?php
/**
 * This file contains the code that displays the course list.
 *
 * @since 2.1.0
 *
 * @package LearnDash\Course
 */

global $post;
?>

<div class="row course-list">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<div class="shop-item-list entry">
			<div>
				<?php the_post_thumbnail( 'learnplus-course-thumb' ); ?>
			</div>
		</div>
	</div>
	<div class="col-md-8 col-md-8">
		<div class="shop-list-desc">
			<?php the_title( '<h4><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></h4>' ); ?>
		</div>
		<div class="shopmeta">
			<?php if ( $post->post_type == 'sfwd-courses' ) : ?>
				<span class="pull-left"><strong><?php esc_html_e( 'Course Price', 'learnplus' ) ?>:</strong> <?php echo LearnPlus_LearnDash::get_price(); ?> </span>
			<?php endif; ?>
			<?php echo LearnPlus_LearnDash::get_rating_html( get_the_ID(), 'pull-right' ) ?>
		</div>
		<hr class="invis clearfix">
		<p><?php the_excerpt() ?></p>
		<a href="<?php the_permalink() ?>" class="btn btn-default btn-sm"><?php esc_html_e( 'Learn More', 'learnplus' ) ?></a>
	</div>
</div>

