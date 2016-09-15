<?php 	
	/*
	===========================================
		THEME SUPPORT OPTIONS
	===========================================
		@package blogastictheme
	*/	
	
	$options = get_option('post_formats');
	$formats = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
	$output = array();
	
	// Get all available formats.
	foreach ($formats as $format){
		$output[] = (@$options[$format] == 1 ? $format : '');
	}
	if(!empty($options)){		
		// Add post formats.
		add_theme_support('post-formats', $output);
	}

	$header = get_option('custom_header');
	if(@$header == 1){		
		// Add custom header.
		add_theme_support('custom-header');
	}

	$background = get_option('custom_background');
	if(@$background == 1){		
		// Add custom background.
		add_theme_support('custom-background');
	}
	
	// Add featured image.
	add_theme_support('post-thumbnails');
	
	// Activate Nav Menu Option - prymary.
	add_action('after_setup_theme', 'blogastic_register_nav_menu');
	function blogastic_register_nav_menu() {
		register_nav_menu('primary', 'Header Navigation Menu');
	}

	// Activate HTML5 features.
	add_theme_support('html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
	