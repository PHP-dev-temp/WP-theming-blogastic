<h1>Blogastic Author Options</h1>
<?php settings_errors(); ?>
<?php 
	
	$picture = esc_attr(get_option('author_picture'));
	$name = esc_attr(get_option('name'));
	$description = esc_attr(get_option('author_description'));	
	$twitter_icon = esc_attr(get_option('twitter_handler'));
	$facebook_icon = esc_attr(get_option('facebook_handler'));
	$gplus_icon = esc_attr(get_option('gplus_handler'));
	
?>
<div class="blogastic-author-preview">
	<div class="image-container">
		<div id="profile-picture-preview" class="profile-picture" style="background-image: url(<?php print $picture; ?>);"></div>
	</div>
	<h1 class="blogastic-username"><?php print $name; ?></h1>
	<h2 class="blogastic-description"><?php print $description; ?></h2>
	<div class="icons-wrapper">
		<?php if(!empty($twitter_icon)): ?>
			<i class="fa fa-twitter" aria-hidden="true"></i>
		<?php endif; 
		if(!empty($facebook_icon)): ?>
			<i class="fa fa-facebook" aria-hidden="true"></i>
		<?php endif; 
		if(!empty($gplus_icon)): ?>
			<i class="fa fa-google-plus" aria-hidden="true"></i>
		<?php endif; ?>
	</div>
</div>

<form id="submitForm" method="post" action="options.php" class="blogastic-general-form">
	<?php settings_fields('blogastic-author-support'); ?>
	<?php do_settings_sections('blogastic_author'); ?>
	<?php submit_button('Save Changes', 'primary', 'btnSubmit'); ?>
</form>