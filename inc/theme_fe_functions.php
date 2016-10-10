<?php 	
	/*
	===========================================
		THEME FRONT END FUNCTIONS
	===========================================
		@package blogastictheme
	*/	

	// Ajax call
	
    add_action( 'wp_ajax_contact_form', 'contact_form_ajax_callback_function' );    // If called from admin panel
    add_action( 'wp_ajax_nopriv_contact_form', 'contact_form_ajax_callback_function' );    // If called from front end
    function contact_form_ajax_callback_function() {
		
        // Implement ajax function		
		$a = 12 / 0;
		// Only process POST reqeusts.
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// Get the form fields and remove whitespace.
			$email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
			$message = htmlspecialchars (trim($_POST["message"]));
			$ip_address = $_SERVER['REMOTE_ADDR'];

			// Check that data was sent to the mailer.
			if ( empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
				// Set a 400 (bad request) response code and exit.
				http_response_code(400);
				echo "Oops! There was a problem with your submission. Please complete the form and try again. $email , $message!";
				exit;
			}

			// Set the recipient email address.
			// FIXME: Update this to your desired email address.
			$recipient = get_bloginfo('admin_email');

			// Build the email content.
			$email_content = '<html><head><style>body { font-family: Verdana, Arial, sans-serif; font-size: 12px; }</style></head><body>';
			$email_content .= "New mail from:<br><br>Email: $email <br>IP: $ip_address <br><br>Message:<br>";
			$email_content .= "Email: $email<br><br>";
			$email_content .= "Message:<br>$message<br></body></html>";

			// Set the email subject.
			$subject = "New contact from $email";

			// Build the email headers.
			$headers = "From: $email\r\n";
			$headers .= "Reply-To: $email\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=utf-8\r\n";

			// Send the email.
			if (mail($recipient, $subject, $email_content, $headers)) {
				// Set a 200 (okay) response code.
				http_response_code(200);
				echo "Thank You! Your message has been sent.";
				exit;
			} else {
				// Set a 500 (internal server error) response code.
				http_response_code(500);
				echo "Oops! Something went wrong and we couldn't send your message.";
				exit;
			}

		} else {
			// Not a POST request, set a 403 (forbidden) response code.
			http_response_code(403);
			echo "There was a problem with your submission, please try again.";
			exit;
		}
    }

	// Display functions
	
	function blogastic_get_category(){
		$output = '';
		$categories = get_the_category();
		if( !empty($categories) ){
			foreach($categories as $category){
				$catSetings = get_option('category-icon-color');
				$name = esc_html($category->name);
				$link = esc_url(get_category_link($category->term_id));
				$icon = isset($catSetings[$name]['icon']) ? $catSetings[$name]['icon'] : 'star';
				$color = isset($catSetings[$name]['color']) ? $catSetings[$name]['color'] : 'grey';
				$output .= '<a href="' . $link . '"><div class="cat-title-icon" style="background-color: ' . $color . '"><i class="fa fa-' . $icon . '" aria-hidden="true"></i></a>';
				break;
			}
		}
		return $output;
	}
	
	function blogastic_posted_meta(){
		$posted_on = human_time_diff( get_the_time('U') , current_time('timestamp') );		
		$categories = get_the_category();
		$separator = ', ';
		$output = '';
		$i = 1;		
		if(!empty($categories)):
			foreach($categories as $category):
				if($i > 1): $output .= $separator; endif;
				$output .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" alt="' . esc_attr('View all posts in%s', $category->name) .'">' . esc_html($category->name) .'</a>';
				$i++; 
			endforeach;
		endif;		
		return '<div><span class="posted-on">Posted <a href="'. esc_url(get_permalink()) .'">' . $posted_on . '</a> ago</span> / <span class="posted-in">' . $output . '</span></div>';
	}

	function blogastic_posted_footer(){		
		$comments_num = get_comments_number();
		if(comments_open()){
			if($comments_num == 0){
				$comments = __('No Comments');
			}elseif ($comments_num > 1){
				$comments= $comments_num . __(' Comments');
			}else{
				$comments = __('1 Comment');
			}
			$comments = '<a class="comments-link" href="' . get_comments_link() . '">'. $comments .' <i class="fa fa-comments blogastic-comments" aria-hidden="true"></i></a>';
		}else{
			$comments = __('Comments are closed');
		}		
		return '<div class="post-footer-container"><div class="row"><div class="col-xs-12 col-sm-6">'. blogastic_posted_meta() . get_the_tag_list('<div class="tags-list"><i class="fa fa-tags blogastic-tags" aria-hidden="true"></i>', ' ', '</div>') . '</div><div class="col-xs-12 col-sm-6 text-right">'. $comments .'</div></div></div>';
	}

	function blogastic_get_attachment($num = 1){		
		$output = '';
		if(has_post_thumbnail() && $num == 1): 
			$output = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
		else:
			$attachments = get_posts(array( 
				'post_type' => 'attachment',
				'posts_per_page' => $num,
				'post_parent' => get_the_ID()
			));
			if($attachments && $num == 1):
				foreach ($attachments as $attachment):
					$output = wp_get_attachment_url($attachment->ID);
				endforeach;
			elseif($attachments && $num > 1):
				$output = $attachments;
			endif;			
			wp_reset_postdata();			
		endif;		
		return $output;
	}
	
	function blogastic_get_embedded_media($type = array()){
		$content = do_shortcode(apply_filters('the_content', get_the_content()));
		$embed = get_media_embedded_in_content($content, $type);
		if (!isset($embed[0]))return null;
		if(in_array('audio' , $type)):
			$output = str_replace('?visual=true', '?visual=false', $embed[0]);
		else:
			$output = $embed[0];
		endif;		
		return $output;
	}
	
	function blogastic_grab_url(){
		if(!preg_match('/<a\s[^>]*?href=[\'"](.+?)[\'"]/i', get_the_content(), $links)){
			return false;
		}
		return esc_url_raw($links[1]);
	}
	
	function blogastic_get_bs_slides($attachments){		
		$output = array();
		$count = count($attachments)-1;		
		for($i = 0; $i <= $count; $i++ ): 		
			$active = ($i == 0 ? ' active' : '' );	
			$output[$i] = array( 
				'class'		=> $active, 
				'url'		=> wp_get_attachment_url($attachments[$i]->ID),
			);		
		endfor;		
		return $output;		
	}
	
	// Add pagination
	function blogastic_pagination_numeric_posts_nav() {
		if(is_singular()) return;
		global $wp_query;
		$output = '';		
		/** Stop execution if there's only 1 page */
		if($wp_query->max_num_pages <= 1) return;		
		$paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
		$max   = intval($wp_query->max_num_pages);		
		/** Add current page to the array */
		if ($paged >= 1) $links[] = $paged;		
		/** Add the pages around the current page to the array */
		if ($paged >= 3) {
			$links[] = $paged - 1;
			$links[] = $paged - 2;
		}
		if (($paged + 2) <= $max) {
			$links[] = $paged + 2;
			$links[] = $paged + 1;
		}
		$output .= '<div class="pagination"><ul>';		
		/** Previous Post Link */
		if (get_previous_posts_link()) $output .= '<li>' . get_previous_posts_link() . '</li>';		
		/** Link to first page, plus ellipses if necessary */
		if (!in_array(1, $links)) {
			$class = 1 == $paged ? ' class="active"' : '';
			$output .= '<li' . $class . '><a href="' . esc_url(get_pagenum_link(1)) . '">1</a></li>';
			if (!in_array(2, $links)) $output .= '<li>…</li>';
		}		
		/** Link to current page, plus 2 pages in either direction if necessary */
		sort($links);
		foreach ((array) $links as $link) {
			$class = $paged == $link ? ' class="active"' : '';
			$output .= '<li' . $class . '><a href="' . esc_url(get_pagenum_link($link)) . '">' . $link . '</a></li>';
		}		
		/** Link to last page, plus ellipses if necessary */
		if (! in_array($max, $links)) {
			if (!in_array($max - 1, $links)) $output .= '<li>…</li>';
			$class = $paged == $max ? ' class="active"' : '';
			$output .= '<li' . $class . '><a href="' . esc_url(get_pagenum_link($max)) . '">' . $max . '</a></li>';
		}		
		/** Next Post Link */
		if (get_next_posts_link()) $output .= '<li>' . get_next_posts_link() . '</li>';
		$output .= '</ul></div>';		
		return $output;
	}
	
	// Comments navigation
	function blogastic_get_post_navigation(){	
		if(get_comment_pages_count() > 1 && get_option('page_comments')):	
			require(get_template_directory() . '/inc/templates/blogastic-comment-nav.php');	
		endif;	
	}
	
	// Share post
	function blogastic_footer_share_this(){		
		if(is_single()){			
			$title = get_the_title();
			$permalink = get_permalink();			
			$twitterHandler = (get_option('twitter_handler') ? '&amp;via='.esc_attr(get_option('twitter_handler')) : '');
			$twitter = 'https://twitter.com/intent/tweet?text=Hey! Read this: ' . $title . '&amp;url=' . $permalink . $twitterHandler .'';
			$facebook = 'https://www.facebook.com/sharer/sharer.php?u=' . $permalink;
			$google = 'https://plus.google.com/share?url=' . $permalink;
			$shareContent = '<a class="share-link" href="' . $twitter . '" target="_blank" rel="nofollow"><i class="fa fa-twitter" aria-hidden="true"></i></a>';
			$shareContent .= '<a class="share-link" href="' . $facebook . '" target="_blank" rel="nofollow"><i class="fa fa-facebook" aria-hidden="true"></i></a>';
			$shareContent .= '<a class="share-link" href="' . $google . '" target="_blank" rel="nofollow"><i class="fa fa-google-plus" aria-hidden="true"></i></a>';
			$output = '<div class="post-footer-container"><div class="row"><div class="col-xs-12 col-sm-6">'. blogastic_posted_meta() . get_the_tag_list('<div class="tags-list"><i class="fa fa-tags blogastic-tags" aria-hidden="true"></i>', ' ', '</div>') . '</div><div class="col-xs-12 col-sm-6 text-right">Share: '. $shareContent .'</div></div></div>';
			return $output;		
		}else{
			return '';
		}		
	}
	
	// Get all categories.
	function blogastic_get_all_cat(){		
		$catSetings = get_option('category-icon-color');
		$terms = get_terms(array(
			'taxonomy' => 'category',
			'hide_empty' => false,
		));
		$category = array();
		$output = '<ul class="blogastic-custom-cat-widget">';
		foreach ($terms as $term){
			if ($term->parent == 0){
				$name = trim(esc_html($term->name));
				$category[$name]['icon'] = isset($catSetings[$name]['icon']) ? $catSetings[$name]['icon'] : 'star';
				$category[$name]['color'] = isset($catSetings[$name]['color']) ? $catSetings[$name]['color'] : 'grey';
				$output .= '<li><a href="' . get_term_link($term) . '">' . $name . '(' . $term->count . ')';
				$output .= '<i class="fa fa-' . $category[$name]['icon'] . ' widget-category-icon" style="background-color: ' . $catSetings[$name]['color'] . ';" aria-hidden="true"></i>';
				$output .= '</a></li>';
			}
		}
		$output .= '</ul>';
		return $output;
	}
