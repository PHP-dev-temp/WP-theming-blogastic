<?php 	
	/*
	===========================================
		BLOGASTIC FUNCTIONS	
	===========================================
		@package blogastictheme
	*/	
	
	//@ini_set( 'upload_max_size' , '16M' );
	//@ini_set( 'post_max_size', '16M');
	//@ini_set( 'max_execution_time', '300' );
	
	//require get_template_directory() . '/inc/cleanup.php';
	require get_template_directory() . '/inc/enqueue.php';
	require get_template_directory() . '/inc/admin-panel-functions.php';	
	require get_template_directory() . '/inc/theme-support.php';
	require_once get_template_directory() . '/inc/wp_bootstrap_navwalker.php';
	require get_template_directory() . '/inc/theme_fe_functions.php';