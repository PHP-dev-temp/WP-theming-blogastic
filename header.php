<?php 	
	/*
		This is the template for the header		
		@package blogastictheme
	*/	
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<title><?php bloginfo( 'name' ); wp_title(); ?></title>
		<meta name="description" content="<?php bloginfo( 'description' ); ?>">
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php if( is_singular() && pings_open( get_queried_object() ) ): ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif; ?>
		<?php wp_head(); ?>		
	</head>
<body <?php body_class(); ?>>
	<header>
		<div class="container-fluid blogastic-header-top">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 blogastic-header-top-content text-right">
						<ul>
							<li><a href="<?php echo wp_login_url(); ?>" title="Login">LogIn</a></li>						
							<?php if(!empty(get_option('twitter_handler'))): ?>
								<li><a href="https://twitter.com/<?php echo(esc_attr(get_option('twitter_handler'))) ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							<?php endif; 
							if(!empty(get_option('facebook_handler'))): ?>
								<li><a href="http://www.facebook.com/<?php echo(esc_attr(get_option('facebook_handler'))) ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<?php endif; 
							if(!empty(get_option('gplus_handler'))): ?>
								<li><a href="https://plus.google.com/<?php echo(esc_attr(get_option('gplus_handler'))) ?>" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</div>	
		</div><!--.blogastic-header-top-->
		<div class="container-fluid header-content">
			<h1 class="site-logo text-center"><?php bloginfo( 'name' ); ?> <i class="fa fa-pencil" aria-hidden="true"></i></h1>
			<h2 class="site-description text-center"><?php bloginfo( 'description' ); ?></h2>
		</div><!--.header-content-->
		<div class="container-fluid">
			<div class="row">			
				<nav class="navbar navbar-blogastic" role="navigation">
					<div class="container-fluid">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<?php
							if (has_nav_menu('primary')){
								wp_nav_menu(array(
									'menu'              => 'primary',
									'theme_location'    => 'primary',
									'depth'             => 2,
									'container'         => 'div',
									'container_class'   => 'collapse navbar-collapse',
									'container_id'      => 'bs-example-navbar-collapse-1',
									'menu_class'        => 'nav navbar-nav',
									'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
									'walker'            => new wp_bootstrap_navwalker()
								));	
							}
						?>
					</div>
				</nav>
				<div class="header-img-container background-image text-center" style="background-image: url(<?php header_image(); ?>);">
					<div class="table"><!-- Ovo ovde samo za category, tags, archive -->
						<div class="table-cell">
							<div class="title-icon"><i class="fa fa-pencil" aria-hidden="true"></i></div>
							<h1 class="title">Class title</h1>
						</div><!-- .table-cell -->
					</div><!-- .header-content -->
				</div>
			</div>
		</div>
	
	</header>
	