<?php get_header(); 
	if (have_posts()) : while (have_posts()) : the_post();?>
		<section>
			<div class="bg-category bg-image margin-bottom-30" style="background-image: url(<?php the_post_thumbnail_url('full'); ?>)">
				<div class="bg-opacity-dark bg-absolute"></div>
				<div class="content-center text-center padding-left-right-20 color-light">
					<h2 class="margin-bottom-10"><?php the_title(); ?></h2>
					<?php the_content(); ?>					
				</div>
			</div>
			<div class="container">
				<div class="row row-complete">
					<?php $args2 = array(
						'taxonomy' => 'product_cat',
						'child_of' => 0,
						'parent' 	=> 20,
						'hide_empty' => 0
					);
					$sub_cats = get_categories( $args2 );
					if($sub_cats) {
						foreach($sub_cats as $sub_category) { 
						$thumbnail_id = get_woocommerce_term_meta( $sub_category->term_id, 'thumbnail_id', true );
						$image = wp_get_attachment_url( $thumbnail_id ); 
						$catLink = get_category_link( $sub_category->term_id );?>
							<div class="col s12 sm6 m4 margin-bottom-30">
								<a href="<?php echo $catLink; ?>" class="block">
									<div class="bg-subcategory bg-image" style="background-image: url(<?php echo $image; ?>)">
										<h3><?php echo $sub_category->name; ?></h3>
									</div>
								</a>
							</div>
						<?php }
					} ?>
				</div>				
			</div>
		</section>
	<?php endwhile; endif; 
get_footer(); ?>