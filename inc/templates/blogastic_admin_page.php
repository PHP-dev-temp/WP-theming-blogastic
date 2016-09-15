<h1>Blogastic Theme Support</h1>
<?php settings_errors(); ?>

<form method="post" action="options.php" class="blogastic-general-form">
	<?php settings_fields('blogastic-theme-support'); ?>
	<?php do_settings_sections('blogastic_options'); ?>
	<?php submit_button(); ?>
</form>