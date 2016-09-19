<?php
	/*	
		@package blogastictheme
		
		-- Standard Quote Format
	*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blogastic-format-quote'); ?>>
	<header class="entry-header">
		<?php if( blogastic_get_attachment() ): ?>			
			<a class="standard-featured-link" href="<?php the_permalink(); ?>">
				<div class="standard-featured background-image" style="background-image: url(<?php echo blogastic_get_attachment(); ?>);"></div>
			</a>			
		<?php endif; ?>	
		<div class="category-meta">
			<?php 
				echo (blogastic_get_category());
			?>
		</div>	
	</header>	
	<div class="entry-content text-center">		
		<h1 class="quote-content"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo get_the_content(); ?>
		<div class="entry-excerpt">
			<div class="button-container text-center">
				<a href="<?php the_permalink(); ?>" class="btn btn-readmore"><?php _e( 'Read More' ); ?></a>
			</div>
			<?php the_title( '<h2 class="quote-author">- ', ' -</h2>'); ?>
		</div>		
	</div><!-- .entry-content -->	
	<footer class="entry-footer">
		<?php echo blogastic_posted_footer(); ?>
	</footer>	
</article>