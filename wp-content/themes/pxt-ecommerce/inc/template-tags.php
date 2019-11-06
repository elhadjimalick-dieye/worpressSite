<?php
/**
 * @package pxt-ecommerce
 */
if ( ! function_exists( 'pxt_ecommerce_EntryFooter' ) ) {
	// Prints HTML with meta information for the categories, tags and comments.
	function pxt_ecommerce_EntryFooter() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$pxt_ecommerce_categories_list = get_the_category_list( ', ' );
			if ( $pxt_ecommerce_categories_list && pxt_ecommerce_lite_categorized_blog() ) {
				printf( '<span class="cat-links">' . esc_html_e( 'Posted in %1$s', 'pxt-ecommerce' ) . '</span>', $pxt_ecommerce_categories_list ); // WPCS: XSS OK.
			}
			/* translators: used between list items, there is a space after the comma */
			$pxt_ecommerce_tags_list = get_the_tag_list( '', ', ');
			if ( $pxt_ecommerce_tags_list ) {
				printf( '<span class="tags-links">' . esc_html_e( 'Tagged %1$s', 'pxt-ecommerce' ) . '</span>', $pxt_ecommerce_tags_list ); // WPCS: XSS OK.
			}
		}
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html_e( 'Leave a comment', 'pxt-ecommerce' ), esc_html_e( '1 Comment', 'pxt-ecommerce' ), esc_html_e( '% Comments', 'pxt-ecommerce' ) );
			echo '</span>';
		}
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html_e( 'Edit %s', 'pxt-ecommerce' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
}

if ( ! function_exists( 'pxt_ecommerce_PostNavigation' ) ) {
	/**
	 * Display navigation to next/previous post when applicable.
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function pxt_ecommerce_PostNavigation() {
		// Don't print empty markup if there's nowhere to navigate.
		// $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		// $next     = get_adjacent_post( false, '', false );
		// if ( ! $next && ! $previous ) {
		// 	return;
		// }
		?>
		<nav class="navigation posts-navigation" role="navigation">
			<!--Start Pagination-->
			<?php $pxt_ecommerce_lite_nav_type = get_theme_mod('pxt_ecommerce_PaginationType','1');
			if (!empty($pxt_ecommerce_lite_nav_type)) {
				$pxt_ecommerce_lite_pagination = get_the_posts_pagination( array(
					'mid_size' => 2,
					'prev_text' => '<i class="paradox-icon icon-angle-left"></i>' ,
					'next_text' => '<i class="paradox-icon icon-angle-right"></i>',
				) );
				echo $pxt_ecommerce_lite_pagination;
			} else { ?>
				<h2 class="screen-reader-text"><?php esc_html_e('Posts navigation', 'pxt-ecommerce' ); ?></h2>
				<div class="pagination nav-links">
					<?php if ( get_next_posts_link() ) : ?>
						<div class="nav-previous"><?php next_posts_link( '<i class="paradox-icon icon-angle-left"></i>'. esc_html_e('Old posts', 'pxt-ecommerce' ) ); ?></div>
					<?php endif; ?>
					<?php if ( get_previous_posts_link() ) : ?>
						<div class="nav-next"><?php previous_posts_link( esc_html_e('Latest posts ', 'pxt-ecommerce' ).' <i class="paradox-icon icon-angle-right"></i>' ); ?></div>
					<?php endif; ?>
				</div>
			<?php } ?>
			<!--End Pagination-->
		</nav>
		<?php
	}
}
if ( ! function_exists( 'pxt_ecommerce_PostedOn' ) ) {
	// Prints HTML with meta information for the current post-date/time and author.
	function pxt_ecommerce_PostedOn() {
		$pxt_ecommerce_time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$pxt_ecommerce_time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}
		$pxt_ecommerce_time_string = sprintf( $pxt_ecommerce_time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		$pxt_ecommerce_posted_on = sprintf(
			esc_html_x( 'Posted on %s', 'post date', 'pxt-ecommerce' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . esc_html($pxt_ecommerce_time_string) . '</a>'
		);
		$pxt_ecommerce_byline = sprintf(
			esc_html_x( 'by %s', 'post author', 'pxt-ecommerce' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);
		echo '<span class="posted-on">' . esc_html($pxt_ecommerce_posted_on) . '</spanesc_html(><span) class="byline"> ' . esc_html($pxt_ecommerce_byline) . '</span>'; // WPCS: XSS OK.
	}
}
/**
 * Flush out the transients used in pxt_ecommerce_lite_categorized_blog.
 */
function pxt_ecommerce_lite_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'pxt_ecommerce_lite_categories' );
}
/**
 * Returns true if a blog has more than 1 category.
 * @return bool
 */
function pxt_ecommerce_lite_categorized_blog() {
	if ( false === ( $pxt_ecommerce_all_the_cool_cats = get_transient( 'pxt_ecommerce_lite_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$pxt_ecommerce_all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			'number'     => 2, // We only need to know if there is more than one category.
		) );
		// Count the number of categories that are attached to the posts.
		$pxt_ecommerce_all_the_cool_cats = count( $pxt_ecommerce_all_the_cool_cats );
		set_transient( 'pxt_ecommerce_lite_categories', $pxt_ecommerce_all_the_cool_cats );
	}
	if ( $pxt_ecommerce_all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so pxt_ecommerce_lite_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so pxt_ecommerce_lite_categorized_blog should return false.
		return false;
	}
}
add_action( 'edit_category', 'pxt_ecommerce_lite_category_transient_flusher' );
add_action( 'save_post',     'pxt_ecommerce_lite_category_transient_flusher' );
