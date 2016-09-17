<h1>Blogastic Author Options</h1>
<?php settings_errors(); ?>

<div class="blogastic-author-preview-data">	
	<h3 class="footer-title">Author&#39;s words:</h3>
	<blockquote><p class="blogastic-description"><?php echo (esc_attr(get_option('author_description'))); ?></p></blockquote>
	<cite class="blogastic-username"><?php echo (esc_attr(get_option('name'))); ?>
		<?php if(!empty(get_option('twitter_handler'))): ?>
			<a href="https://twitter.com/<?php echo(esc_attr(get_option('twitter_handler'))) ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
		<?php endif; 
		if(!empty(get_option('facebook_handler'))): ?>
			<a href="http://www.facebook.com/<?php echo(esc_attr(get_option('facebook_handler'))) ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
		<?php endif; 
		if(!empty(get_option('gplus_handler'))): ?>
			<a href="https://plus.google.com/<?php echo(esc_attr(get_option('gplus_handler'))) ?>" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
		<?php endif; ?>
	</cite>
	<div class="image-container">
		<img src="<?php echo (esc_attr(get_option('author_picture'))); ?>" alt="Profile image">
	</div>
</div>

<form id="submitForm" method="post" action="options.php" class="blogastic-general-form">
	<?php settings_fields('blogastic-author-support'); ?>
	<?php do_settings_sections('blogastic_author'); ?>
	<?php submit_button('Save Changes', 'primary', 'btnSubmit'); ?>
</form>