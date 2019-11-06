<?php
/**
 * The sidebar containing the main widget area.
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
$pxt_ecommerce_sidebar = pxt_ecommerce_CustomSidebar(); ?>
<div id="sidebars" class="sidebar col-md-4 col-xm-12">
	<div class="row">
		<div class="col-md-12">
			<?php if ( ! dynamic_sidebar( $pxt_ecommerce_sidebar )) { ?>
				<div id="sidebar-search" class="widget">
					<h3><?php esc_html_e('Search', 'pxt-ecommerce'); ?></h3>
					<div class="widget-wrap">
						<?php get_search_form(); ?>
					</div>
				</div>
				<div id="sidebar-archives" class="widget">
					<h3><?php esc_html_e('Archives', 'pxt-ecommerce') ?></h3>
					<div class="widget-wrap">
						<ul>
							<?php wp_get_archives( 'type=monthly' ); ?>
						</ul>
					</div>
				</div>
				<div id="sidebar-meta" class="widget">
					<h3><?php esc_html_e('Meta', 'pxt-ecommerce') ?></h3>
					<div class="widget-wrap">
						<ul>
							<?php wp_register(); ?>
							<li><?php wp_loginout(); ?></li>
							<?php wp_meta(); ?>
						</ul>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
	<!--sidebars-->
</div>