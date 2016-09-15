<?php
	/*
	===========================================
		ADMIN ENQUEUE FUNCTIONS	
	===========================================
		@package blogastictheme
	*/

	add_action( 'admin_enqueue_scripts', 'blogastic_load_admin_scripts' );
	function blogastic_load_admin_scripts( $hook ){
		//echo $hook;
		
		// Register css admin section.
		// wp_register_style( string $handle, string $src, array $deps = array(), string|bool|null $ver = false, string $media = 'all' )
		// wp_register_style( 'raleway-admin', 'https://fonts.googleapis.com/css?family=Raleway:200,300,500' ); // Google fonts
		wp_register_style('font-awesome', get_stylesheet_directory_uri() . '/fonts/font-awesome-4.6.3/css/font-awesome.min.css', array(), '4.6.3', 'all');
		wp_register_style('blogastic_admin', get_template_directory_uri() . '/css/blogastic.admin.css', array(), '1.0.0', 'all');
		
		// Register js admin section
		// wp_register_script( string $handle, string $src, array $deps = array(), string|bool|null $ver = false, bool $in_footer = false )
		wp_register_script( 'blogastic-admin-script', get_template_directory_uri() . '/js/blogastic.admin.js', array('jquery'), '1.0.0', true );
		
		
		switch ($hook){			
			// General options
			case 'toplevel_page_blogastic_options':
			
			break;	
			// Category options			
			case 'blogastic_page_blogastic_cat_options':
				wp_enqueue_style('font-awesome');
				wp_enqueue_style('blogastic_admin');
				wp_enqueue_script('blogastic-admin-script');
				// Color picker
				wp_enqueue_style('wp-color-picker');
				wp_enqueue_script('my-script-handle', get_template_directory_uri() . '/js/blogastoc.cp.script.js', array('wp-color-picker'), false, true);
			break;			
			// Author options
			case 'blogastic_page_blogastic_author_options':
			
			break;
		}
		return;
	}


	/*
		
		========================
			FRONT-END ENQUEUE FUNCTIONS
		========================
	

	add_action( 'wp_enqueue_scripts', 'sunset_load_scripts' );
	function sunset_load_scripts(){
		
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.6', 'all' );
		wp_enqueue_style( 'sunset', get_template_directory_uri() . '/css/sunset.css', array(), '1.0.0', 'all' );
		wp_enqueue_style( 'raleway', 'https://fonts.googleapis.com/css?family=Raleway:200,300,500' );
		
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery' , get_template_directory_uri() . '/js/jquery.js', false, '1.11.3', true );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.6', true );
		wp_enqueue_script( 'sunset', get_template_directory_uri() . '/js/sunset.js', array('jquery'), '1.0.0', true );
		
	}*/