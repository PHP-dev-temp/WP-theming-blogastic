<h1>Blogastic Category Options</h1>
<?php settings_errors(); ?>

<form method="post" action="options.php" class="blogastic-general-form">
	<?php settings_fields('blogastic-category-support'); ?>
	<?php do_settings_sections('blogastic_cat_options'); ?>
	<?php submit_button(); ?>
</form>