<?php 	
	/*
	===========================================
		THEME WIDGETS FUNCTIONS
	===========================================
		@package blogastictheme
	*/	
	
	// Change default category widget
	add_filter('wp_list_categories', 'blogastic_add_span_cat_count');
	function blogastic_add_span_cat_count($links) {
		$links = str_replace('</a> (', '</a><span>(', $links);
		$links = str_replace(')', ')</span>', $links);
	return $links;
	}
	
	// Change default tags font size - Tag widget
	add_filter('widget_tag_cloud_args', 'blogastic_tag_cloud_font_change');
	function blogastic_tag_cloud_font_change($args){	
		$args['smallest'] = 8;
		$args['largest'] = 8;		
		return $args;	
	}
	
	// Register and load the widget
	add_action('widgets_init', 'blogastic_category_load_widget');
	function blogastic_category_load_widget(){
		register_widget('Blogastic_Category_Widget');
	}
	
	// Custom category widget
	class Blogastic_Category_Widget extends WP_Widget{
		
		// setup the widget name, description, etc...
		public function __construct(){	
		
			// _construct(Base ID of your widget, Widget name will appear in UI, Widget description)
			parent::__construct('blogastic_category', __('Blogastic Category', 'blogastic_category_domain'), array( 'description' => __( 'Blogastic Custom Category', 'blogastic_category_domain' ),));			
		}		
		
		//back-end display of widget
		public function form( $instance ){
			if (isset($instance['title'])){
				$title = $instance['title'];
			}else{
				$title = __( 'New title', 'blogastic_category_domain' );
			}
			
			// Widget admin form
			?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
			<?php
		}

		// Updating widget replacing old instances with new
		public function update($new_instance, $old_instance) {
			$instance = array();
			$instance['title'] = (!empty( $new_instance['title'])) ? strip_tags($new_instance['title']) : '';
			return $instance;
		}
		
		// front-end display of widget
		public function widget($args, $instance) {
			$title = apply_filters('widget_title', $instance['title']);
			
			// before and after widget arguments are defined by themes
			echo $args['before_widget'];
			if (!empty($title)) echo $args['before_title'] . $title . $args['after_title'];			
			echo blogastic_get_all_cat();
			echo $args['after_widget'];
		}		
	}
	
	/**
	 * Add one or more classes to the WordPress search form's 'Search' button
	 * @author Alain Schlesser (alain.schlesser@gmail.com)
	 * @link http://www.brightnucleus.com/add-class-wordpress-search-button/
	 *
	 * @param  string  $form   the search form HTML output
	 * @return string          modified version of the search form HTML output
	 *
	 * @see http://codex.wordpress.org/Function_Reference/get_search_form
	 * @see http://developer.wordpress.org/reference/hooks/get_search_form/
	 */
	function as_adapt_search_form($form) {
		// $forms contains the rendered HTML output of the standard search form
		// the exact output is changed if your theme has declared HTML5 support
		// with the following minimum settings:
		//
		// add_theme_support( 'html5', array( 'search-form' ) );
		//
		// see http://codex.wordpress.org/Function_Reference/add_theme_support
		// add Foundation classes to the button class
		//
		// we do a string replace and search for 'search-submit', which is the one
		// class that is already defined for the HTML5 search form
		//
		// if HTML5 search-form support has not been defined, this will leave the
		// HTML output unchanged
		$form = str_replace(
			'search-form',
			'search-form form-inline',
			$form
		);
		$form = str_replace(
			'search-field',
			'search-field form-control',
			$form
		);
		$form = str_replace(
			'search-submit',
			'search-submit btn btn-default',
			$form
		);
		// return the modified string
		return $form;
	}
	// run the search form HTML output through the newly defined filter
	add_filter( 'get_search_form', 'as_adapt_search_form' );
