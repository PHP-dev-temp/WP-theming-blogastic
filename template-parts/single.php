<?php
	/*	
		@package blogastictheme
		
		-- Standard Single Post Format
	*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
	<header class="entry-header text-center">		
		<?php the_title( '<h1 class="entry-title">', '</h1>'); ?>		
	</header>	
	<div class="entry-content clearfix">		
		<?php the_content(); ?>		
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php echo blogastic_posted_footer(); ?>
	</footer>	
	<?php
		if (comments_open()):
			comments_template();
		endif;
	?>
</article>















