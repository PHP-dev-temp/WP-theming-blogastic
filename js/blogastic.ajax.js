jQuery(document).ready(function($) {	

    // Ajax contact form
    // Get the form.
    var form = $('#ajax-contact');
    // Get the messages div.
    var formMessages = $('#form-messages');
    // Set up an event listener for the contact form.
    $(form).submit(function(event) {
        // Stop the browser from submitting the form.
        event.preventDefault();
		email = $('#email').val();
		message = $('#message').val();
        // Submit the form using AJAX.
        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data: {
				action : 'contact_form',
				email : email,
				message : message
			}
        })
		.done(function(response) {
			// Make sure that the formMessages div has the 'success' class.
			$(formMessages).removeClass('error');
			$(formMessages).addClass('success');
			// Set the message text.
			$(formMessages).text(response);
			// Clear the form.
			$('#subject').val('');
			$('#email').val('');
			$('#message').val('');
		})
		.fail(function(data) {
			// Make sure that the formMessages div has the 'error' class.
			$(formMessages).removeClass('success');
			$(formMessages).addClass('error');
			// Set the message text.
			if (data.responseText !== '') {
			$(formMessages).text(data.responseText);
			} else {
			$(formMessages).text('Oops! An error occured and your message could not be sent.');
			}
		});
    });
});