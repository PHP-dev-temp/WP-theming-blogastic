<?php
	/*	
		@package blogastictheme
		
		-- Galery Post Format
	*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blogastic-format-gallery'); ?>>
	<header class="entry-header">	
		<?php if(blogastic_get_attachment()): ?>			
			<div id="post-gallery-<?php the_ID(); ?>" class="carousel slide blogastic-carousel-thumb" data-ride="carousel">
				<div class="carousel-inner" role="listbox">
				<?php 
					$attachments = blogastic_get_bs_slides(blogastic_get_attachment(7));
					foreach($attachments as $attachment):
				?>					
						<div class="item<?php echo $attachment['class']; ?> background-image standard-featured" style="background-image: url(<?php echo $attachment['url']; ?>);">							
							<div class="hide next-image-preview" data-image="<?php echo $attachment['next_img']; ?>"></div>
							<div class="hide prev-image-preview" data-image="<?php echo $attachment['prev_img']; ?>"></div>
							<div class="entry-excerpt image-caption">
								<p><?php echo $attachment['caption']; ?></p>
							</div>							
						</div>					
					<?php endforeach; ?>					
				</div><!-- .carousel-inner -->				
				<a class="left carousel-control" href="#post-gallery-<?php the_ID(); ?>" role="button" data-slide="prev">
					<div class="table">
						<div class="table-cell">
							
							<div class="preview-container">
								<span class="thumbnail-container background-image"></span>
								<span class="sunset-icon sunset-chevron-left" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</div><!-- .preview-container -->
							
						</div><!-- .table-cell -->
					</div><!-- .table -->
				</a>
				<a class="right carousel-control" href="#post-gallery-<?php the_ID(); ?>" role="button" data-slide="next">
					<div class="table">
						<div class="table-cell">
							
							<div class="preview-container">
								<span class="thumbnail-container background-image"></span>
								<span class="sunset-icon sunset-chevron-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</div><!-- .preview-container -->
							
						</div><!-- .table-cell -->
					</div><!-- .table -->
				</a>
				
			</div><!-- .carousel -->			
		<?php endif; ?>	
		<div class="category-meta">
			<?php 
				echo (blogastic_get_category());
			?>
		</div>	
	</header>	
	<div class="entry-content text-center">		
		<?php the_title( '<h1 class="entry-title"><a href="'. esc_url( get_permalink() ) .'" rel="bookmark">', '</a></h1>'); ?>	
		<div class="entry-excerpt">
			<div class="button-container text-center">
				<a href="<?php the_permalink(); ?>" class="btn btn-readmore"><?php _e( 'Read More' ); ?></a>
			</div>
			<?php the_excerpt(); ?>
		</div>		
	</div><!-- .entry-content -->	
	<footer class="entry-footer">
		<?php echo blogastic_posted_footer(); ?>
	</footer>	
</article>