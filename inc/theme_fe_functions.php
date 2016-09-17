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
			} else {
				// Set a 500 (internal server error) response code.
				http_response_code(500);
				echo "Oops! Something went wrong and we couldn't send your message.";
			}

		} else {
			// Not a POST request, set a 403 (forbidden) response code.
			http_response_code(403);
			echo "There was a problem with your submission, please try again.";
		}
    }
