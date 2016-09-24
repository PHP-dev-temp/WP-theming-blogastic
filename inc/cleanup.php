<?php 	
	/*
	===========================================
		THEME SUPPORT OPTIONS
	===========================================
		@package blogastictheme
	*/	
	

	/* remove version string from js and css */
	add_filter('script_loader_src', 'blogastic_remove_wp_version_strings');
	add_filter('style_loader_src', 'blogastic_remove_wp_version_strings');
	function blogastic_remove_wp_version_strings($src){		
		global $wp_version;
		parse_str(parse_url($src, PHP_URL_QUERY), $query);
		if(!empty($query['ver']) && $query['ver'] === $wp_version){
			$src = remove_query_arg('ver', $src);
		}
		return $src;		
	}

	/* remove metatag generator from header */
	add_filter('the_generator', 'blogastic_remove_meta_version');
	function blogastic_remove_meta_version(){
		return '';
	}