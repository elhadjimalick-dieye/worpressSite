<?php
/**
 * Template Name:  Store Home Page
 * The main template file
 * Used to display the homepage when home.php doesn't exist.
 * @link http://codex.wordpress.org/Template_Hierarchy
 */
?>
<?php get_header(); ?>
<section id="sliderbox">
	<div class="container">
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
	    <!-- <ol class="carousel-indicators">
		      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		      <li data-target="#myCarousel" data-slide-to="1"></li>
		      <li data-target="#myCarousel" data-slide-to="2"></li>
		  </ol> -->

		  <!-- Wrapper for slides -->
		<div class="carousel-inner">
		  	<?php
		  	$showContent = get_theme_mod('pxt_ecommerce_slider_show_content', 'on'); 
		  	$isStatic = true;
		  	$img = '';
		  	for($i=1;$i<=4;$i++){
		  		$img = get_theme_mod('pxt_ecommerce_slider_'.$i);
		  		
		  		if(!empty($img)){
		  			$isStatic = false;
		  		}

		  	}

	  		$count = 0 ;
		  	if($isStatic == false){
		  		for($i=1;$i<=4;$i++){
		  			$pxt_ecommerce_slider = get_theme_mod('pxt_ecommerce_slider_'.$i);
		  			if(!empty($pxt_ecommerce_slider) && is_numeric($pxt_ecommerce_slider)){
		  				$args = array( 
							'page_id' => absint($pxt_ecommerce_slider) 
						);
						$query = new WP_Query($args);
						if( $query->have_posts() ):
							$count++;
							while($query->have_posts()) : $query->the_post();
				  			?>
				  			<div class="item <?php if($i == 1){echo 'active';}?>">
				  				<?php
				  				if ( has_post_thumbnail() ) {
				  					the_post_thumbnail('full',array('class'=>'', 'style'=>"width:100%;"));
				  				}else{
				  					echo '<img src="'.get_template_directory_uri().'/images/banner.jpg" alt="">';
				  				}
				  				?>
				  				<!-- <img src="<?php echo esc_url($img);?>" alt="<?php echo esc_attr($title); ?>" style="width:100%;"> -->
				  				<?php
				  				if($showContent == 'on'){
				  					?>
				  					<div class="carousel-caption">
				  						<h3><?php the_title(); ?></h3>
				  						<!-- <p>
				  							<?php 
					  						/*if(has_excerpt()){
												echo get_the_excerpt();
											}else{
												echo lz_fitness_excerpt( get_the_content(), 30); 
											}*/ ?>
										</p> -->
				  					</div>
				  					<?php
				  				}
				  				?>
				  			</div>
				  			<?php
							endwhile;
							wp_reset_postdata();
						endif;
		  			}
		  		}
		  	}else{
		  		for($i=0;$i<2;$i++){
		  			$count++;
		  			?>
		  			<div class="item <?php if($i == 0){echo 'active';}?>">
		  				<img src="<?php echo esc_url(get_template_directory_uri().'/images/banner.jpg');?>" alt="<?php esc_attr('Slider', 'pxt-ecommerce');?>" style="width:100%;">
		  				<?php
		  				if($showContent == 'on'){
		  					?>
		  					<div class="carousel-caption">
		  						<p><?php __('80% off for sellect items', 'pxt-ecommerce');?></p>
								<h3><?php __('Fashion mega sale', 'pxt-ecommerce');?></h3>
		  					</div>
		  					<?php
		  				}
		  				?>
		  			</div>
				<?php
				}
				}?>
			
		</div>
		<?php 
		if($count>1){
			?>
			<!-- Left and right controls -->
			<a class="left carousel-control" href="#myCarousel" data-slide="prev">
			  	<span class="fa fa-angle-left" aria-hidden="true"></span>
			  	<span class="sr-only"><?php __('Previous', 'pxt-ecommerce');?></span>
			</a>
			<a class="right carousel-control" href="#myCarousel" data-slide="next">
			  	<span class="fa fa-angle-right" aria-hidden="true"></span>
			  	<span class="sr-only"><?php __('Next', 'pxt-ecommerce');?></span>
			</a>
			<?php
		}?>
	</div>
	</div>
</section>

<section class="pxt-products-categories">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2><?php esc_html_e('Categories', 'pxt-ecommerce'); ?></h2>
			</div>
			<?php 
			$orderby = 'name';
			$order = 'asc';
			$hide_empty = false ;
			$cat_args = array(
				'orderby'    => $orderby,
				'order'      => $order,
				'hide_empty' => $hide_empty,
			);
			$product_categories = get_terms( 'product_cat', $cat_args );
			if( !empty($product_categories) && function_exists('get_woocommerce_term_meta')){
				echo '<ul>';
				foreach ($product_categories as $key => $category) {
		    		// print_r($category);
					$thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
					$image = wp_get_attachment_url( $thumbnail_id );
					?>
					<div class="col-md-3">
						<div class="product-item">
							<a href="<?php echo esc_url(get_term_link($category));?>" >
								<?php
								if ( $image ) {
									echo '<img src="' . esc_url($image) . '" alt="' . esc_attr($category->name) . '" />';
								}else{
									echo '<img src="'. esc_url(get_template_directory_uri()).'/images/nothumb-featured.png" alt="' .esc_attr( $category->name) . '" />';
								}
								?>
								<h3><?php echo esc_html(ucwords($category->name));?></h3>
							</a>
						</div>
					</div>
					<?php
				}
				echo '</ul>';
			}else{
				?>
				<div class="col-md-12">
					<div class="alert alert-warring">
						<?php 
						if(is_admin()){ 
							?>
							<h2><?php esc_html_e('Please install woocommerce plugin.', 'pxt-ecommerce'); ?></h2>
						<?php }else{ 
							?>
							<h2><?php esc_html_e('No products to show.', 'pxt-ecommerce'); ?></h2>
						<?php } ?>
					</div>	
				</div>
				<?php
				}
			?>
		</div>
	</div>
</section>

<section class="pxt-products">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2><?php esc_html_e('Products', 'pxt-ecommerce'); ?></h2>
			</div>
			<?php 
			$args = array(
				'post_type'      => 'product',
				'posts_per_page' => 8,
				// 'product_cat'    => 'hoodies'
			);
			$loop = new WP_Query( $args );
			if($loop->have_posts() && function_exists('woocommerce_get_product_thumbnail')){
				$l = 0;
				while ( $loop->have_posts() ) : $loop->the_post();
					$l++;
					global $product;
					?>
					<div class="col-md-3">
						<div class="product-item">
							<a href="<?php echo esc_url(get_permalink())?>">
								<div>
									<?php echo woocommerce_get_product_thumbnail();?>
									<div class="clearfix"></div>
								</div>
								<h3><?php echo esc_attr(ucwords(get_the_title()));?></h3>
							</a>
							<span class="price"><?php echo $product->get_price_html(); ?></span>
						</div>
					</div>
					<?php
					if($l%4 ==0){
						echo '<div class="clearfix"></div>
						</div>
						<div class="row">';
					}
				endwhile;
				wp_reset_postdata();
			}else{
				?>
				<div class="col-md-12">
					<div class="alert alert-warring">
						<?php if(is_admin()){?>
							<h2><?php esc_html_e('Please install woocommerce plugin.', 'pxt-ecommerce'); ?></h2>
						<?php }else{ ?>
							<h2><?php esc_html_e('No products to show.', 'pxt-ecommerce'); ?></h2>
						<?php } ?>
					</div>	
				</div>
				<?php
			}
			?>
			<div class="clearfix"></div>
		</div>
	</div>
</section>
<?php get_footer(); 
