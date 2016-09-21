<?php
	/*	
		@package blogastictheme
		
		-- Link Post Format
	*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blogastic-format-link'); ?>>
	<header class="entry-header">	
		<?php if( blogastic_get_attachment() ): ?>			
				<div class="standard-featured background-image" style="background-image: url(<?php echo blogastic_get_attachment(); ?>);"></div>
		<?php endif; ?>	
		<div class="category-meta">
			<?php 
				echo (blogastic_get_category());
			?>
		</div>	
	</header>	
	<div class="entry-content text-center">			
		<?php 
			$link = blogastic_grab_url();
			the_title( '<h1 class="entry-title link-title"><a href="' . $link . '" target="_blank">', '<div class="link-icon"><span class="sunset-icon sunset-link"></span></div></a></h1>'); 
		?>
	</div><!-- .entry-content -->	
	<footer class="entry-footer">
		<?php echo blogastic_posted_footer(); ?>
	</footer>	
</article>