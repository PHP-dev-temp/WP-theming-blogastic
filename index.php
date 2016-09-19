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
						
						<div class="row blogastic-pagination">
							<div class="col-xs-6 text-left"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i><?php next_posts_link( 'Older posts' ); ?></div>
							<div class="col-xs-6 text-right"><?php previous_posts_link( 'Newer posts' ); ?><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></div>
						</div>
	
					</div><!--.main-container-content-->
				<div class="col-md-4 saidbar-container-content">
	<!-- ovde da dodam sidebar -->
				</div><!--.saidbar-container-content-->
			</div><!--.row-->	
		</div><!--.container-->
	</div><!--.container-fluid-->
	
<?php get_footer(); ?>