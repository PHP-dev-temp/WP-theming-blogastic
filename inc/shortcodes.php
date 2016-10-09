<?php 	
	/*
	===========================================
		      THEME SHORTCODES
	===========================================
		@package blogastictheme
	*/	

add_shortcode('tooltip', 'blogastic_tooltip' );	
function blogastic_tooltip($atts, $content = null) {
	
	//[tooltip placement="top" title="This is the title"]This is the content[/tooltip]	
	//get the attributes
	$atts = shortcode_atts(
		array(
			'placement' => 'top', 
			'title' => '',
		),
		$atts,
		'tooltip'
	);	
	$title = ($atts['title'] == '' ? $content : $atts['title']);
	
	//return HTML
	return '<span class="blogastic-tooltip" data-toggle="tooltip" data-placement="' . $atts['placement'] . '" title="' . $title . '">' . $content . '</span>';	
}

add_shortcode('popover', 'blogastic_popover');
function blogastic_popover($atts, $content = null) {
	
	//[popover title="Popover title" placement="top" trigger="click" content="This is the Popover content"]This is the clickable content[/popover]	
	//get the attributes
	$atts = shortcode_atts(
		array(
			'placement' => 'top',
			'title' => '',
			'trigger' => 'click',
			'content' => '',
		),
		$atts,
		'popover'
	);
	
	//return HTML
	return '<span class="blogastic-popover" data-toggle="popover" data-placement="' . $atts['placement'] . '" title="' . $atts['title'] . '" data-trigger="' . $atts['trigger'] . '" data-content="' . $atts['content'] . '">' . $content . '</span>';		
}