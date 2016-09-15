<?php 	
	/*
	===========================================
		ADMIN PAGE	
	===========================================
		@package blogastictheme
	*/	
	
	// Add menu items in Admin panel.
	add_action('admin_menu', 'blogastic_add_admin_page');
	function blogastic_add_admin_page(){
		
		// Add a top-level menu page.
		// add_menu_page( string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', string $icon_url = '', int $position = null )
		add_menu_page('Blogastic Theme Options', 'Blogastic', 'manage_options', 'blogastic_options', 'blogastic_theme_create_page', get_template_directory_uri() . '/img/blogastic-icon.png', 110);
		
		// Add a submenu page.
		//add_submenu_page( string $parent_slug, string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '' )
		
		// General options - same callback function as parrent.
		add_submenu_page('blogastic_options', 'Blogastic Theme Options', 'General options', 'manage_options', 'blogastic_options', 'blogastic_theme_create_page');
		
		// Post categories options.
		add_submenu_page('blogastic_options', 'Blogastic Category Options', 'Post categories options', 'manage_options', 'blogastic_cat_options', 'blogastic_category_options_page');
		
		// Author options.
		add_submenu_page('blogastic_options', 'Blog Author Options', 'Blog author options', 'manage_options', 'blogastic_author_options', 'blogastic_author_options_page');
	}
	
	/*
	===========================================
		Template functions	
	===========================================
	*/
	
	// Template for Blogastic Theme Options.
	function blogastic_theme_create_page(){
		require_once(get_template_directory() . '/inc/templates/blogastic_admin_page.php');
	}
	
	// Template for Categories options.
	function blogastic_category_options_page(){
		require_once(get_template_directory() . '/inc/templates/blogastic_admin_page_category.php');
	}
	
	// Template for Author options.
	function blogastic_author_options_page(){
		require_once(get_template_directory() . '/inc/templates/blogastic_admin_page_author.php');
	}
	
	/*
	===========================================
		Custom settings
	===========================================
	*/
	
	// Activate custom settings.
	add_action('admin_init', 'blogastic_custom_settings');
	function blogastic_custom_settings(){
		
		// Theme Support Options.
		
		// Register a setting and its sanitization callback. 
		// register_setting( string $option_group, string $option_name, callable $sanitize_callback = '' )
		register_setting('blogastic-theme-support', 'post_formats');
		register_setting('blogastic-theme-support', 'custom_header');
		register_setting('blogastic-theme-support', 'custom_background');
		
		// Add a new section to a settings page.
		// add_settings_section( string $id, string $title, callable $callback, string $page )
		add_settings_section('blogastic-theme-options', 'Theme options', 'blogastic_theme_support_callback', 'blogastic_options');
		
		// Add a new field to a section of a settings page.
		// add_settings_field( string $id, string $title, callable $callback, string $page, string $section = 'default', array $args = array() )
		add_settings_field('post-formats', 'Post Formats', 'blogastic_post_formats_callback', 'blogastic_options', 'blogastic-theme-options');
		add_settings_field('custom-header', 'Custom Header', 'blogastic_custom_header_callback', 'blogastic_options', 'blogastic-theme-options');
		add_settings_field('custom-background', 'Custom Background', 'blogastic_custom_background_callback', 'blogastic_options', 'blogastic-theme-options');
		// TODO sidebar options		
		
		// Categories options.
		
		// Register Category settings
		register_setting('blogastic-category-support', 'category-icon-color');
		
		// Add a new section.
		add_settings_section('blogastic-category-options', 'Category icons and colors', 'blogastic_category_support_callback', 'blogastic_cat_options');
		
		// Add a new field.
		add_settings_field('category-icon-color', 'Choose favorite colors and icons for your categories!', 'blogastic_category_callback', 'blogastic_cat_options', 'blogastic-category-options');
	}	
	
	/*
	===========================================
		Callback functions
	===========================================
	*/
	
	// Theme Support Options.	
	function blogastic_theme_support_callback(){
		echo 'Activate and Deactivate specific Theme Support Options';
	}
	
	// Category Support Options
	function blogastic_category_support_callback(){
		echo 'To change icon, click the exist icon and choose new one.';
	}
	
	function blogastic_post_formats_callback(){
		$options = get_option('post_formats');
		$formats = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
		$output = '';
		foreach ($formats as $format){
			$checked = (@$options[$format] == 1 ? 'checked' : '');
			$output .= '<label><input type="checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1" '.$checked.' /> '.$format.'</label><br>';
		}
		echo $output;
	}

	function blogastic_custom_header_callback(){
		$options = get_option('custom_header');
		$checked = (@$options == 1 ? 'checked' : '');
		echo '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.' /> Activate the Custom Header</label>';
	}

	function blogastic_custom_background_callback(){
		$options = get_option('custom_background');
		$checked = (@$options == 1 ? 'checked' : '');
		echo '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.' /> Activate the Custom Background</label>';
	}
	
	function blogastic_category_callback(){
		require get_template_directory() . '/inc/templates/blogastic_admin_page_category_template.php';
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	