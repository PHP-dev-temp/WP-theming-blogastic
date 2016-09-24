<?php 
	/*	
		@package blogastictheme
	*/	
?>
<?php get_header(); ?>	
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">	
			<div class="container-fluid  blogastic-base-conainer">
				<div class="container">
					<div class="row">
						<div class="col-md-8 main-container-content">							
							<?php 								
								if(have_posts()):									
									while(have_posts()): the_post();	
										get_template_part('template-parts/single', get_post_format());
									endwhile;									
								endif;							
							?>								
						</div>		
						<div class="col-md-4 saidbar-container">
							<?php get_sidebar(); ?>
						</div><!--.saidbar-container-content-->				
					</div><!-- .row -->
				</div><!-- .container -->
			</div>				
		</main>
	</div><!-- #primary -->	
<?php get_footer(); ?>