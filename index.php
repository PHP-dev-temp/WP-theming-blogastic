<?php 	
	/*	
		@package blogastictheme
	*/	
?>
<?php get_header(); ?>		
	<div class="container-fluid  blogastic-base-conainer">
		<div class="container">
			<div class="row">
				<div class="col-md-8 main-container-content">

						<div id="primary" class="content-area">
							<main id="main" class="site-main" role="main">
								<div class="blogastic-posts-container">				
									<?php 					
										if(have_posts()):
											while(have_posts()): 
												the_post();
												get_template_part('template-parts/content', get_post_format());
											endwhile;
										endif;
									?>
								</div><!-- .blogastic-posts-container -->
							</main>
						</div>
						
						<?php if(blogastic_pagination_numeric_posts_nav()): ?>
							<div class="row blogastic-pagination">
							<?php echo (blogastic_pagination_numeric_posts_nav()); ?>
							</div>
						<?php endif; ?>

	
					</div><!--.main-container-content-->
				<div class="col-md-4 saidbar-container">
					<?php get_sidebar(); ?>
				</div><!--.saidbar-container-content-->
			</div><!--.row-->	
		</div><!--.container-->
	</div><!--.container-fluid-->
	
<?php get_footer(); ?>