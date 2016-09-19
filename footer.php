<?php 	
	/*
		This is the template for the footer		
		@package blogastictheme
	*/	
?>

	<div class="container-fluid footer-container">
		<footer>
			<div class="container footer-content">
				<div class="row clearfix">
					<div class="col-sm-6 col-sm-push-6 col-md-4 col-md-push-4">	
						<h3 class="footer-title">Author&#39;s words:</h3>
						<blockquote><p class="blogastic-description"><?php echo (esc_attr(get_option('author_description'))); ?></p></blockquote>
						<cite class="blogastic-username"><?php echo (esc_attr(get_option('name'))); ?>
							<?php if(!empty(get_option('twitter_handler'))): ?>
								<a href="https://twitter.com/<?php echo(esc_attr(get_option('twitter_handler'))) ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
							<?php endif; 
							if(!empty(get_option('facebook_handler'))): ?>
								<a href="http://www.facebook.com/<?php echo(esc_attr(get_option('facebook_handler'))) ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
							<?php endif; 
							if(!empty(get_option('gplus_handler'))): ?>
								<a href="https://plus.google.com/<?php echo(esc_attr(get_option('gplus_handler'))) ?>" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
							<?php endif; ?>
						</cite>
					</div>
					<div class="col-sm-6 col-sm-pull-6 col-md-4 col-md-pull-4">
						<div class="image-container">
							<img src="<?php echo (esc_attr(get_option('author_picture'))); ?>" alt="Profile image" class="img-responsive">
						</div>
					</div>
					<div class="col-md-4">
						<form id="ajax-contact" method="post" action="<?php echo admin_url('admin-ajax.php'); ?>" class="ajax-contact">
							<div class="row">							
								<h3 class="footer-title">Send me message</h3>	
								<div class="col-xs-12">
									<div class="form-group">
										<input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
									</div>
								</div>
								<div class="col-xs-12">
									<div class="form-group">
										<textarea id="message" class="form-control" rows="3" placeholder="Message" name="message" required></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div id="form-messages" class="col-md-9"></div>
								<div class="col-md-3 text-right">
									<button type="submit" class="btn" name="submit" value="submit">Send</button>
								</div>							
							</div>
						</form>
					</div>
				</div>
			</div>
		</footer>
	</div>
<?php wp_footer(); ?>
</body>
</html>