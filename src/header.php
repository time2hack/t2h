<?php

/**
 * Displays the header section of the theme.
 *
 * @package T2H
 * @subpackage Time to Hack
 * @since T2H 1.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="<?php bloginfo('charset'); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="../bower_components/html5shiv/dist/html5shiv.js"></script>
	  <script src="../bower_components/respond/dest/respond.min.js"></script>
	<![endif]-->
	<?php
		/** 
		 * This hook is important for wordpress plugins and other many things
		 */
		wp_head();
	?>
</head>
<body>
	<header>
		<div class="container">
		  	<div class="page-header" id="banner">
				<h1><a href="<?php bloginfo('url') ?>"><?php bloginfo('name') ?></a></h1>
				<p class="lead" style="margin-bottom: 10px;"><?php bloginfo('description') ?></p>
			</div>
			<div><center><iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Ftime2hack&amp;width&amp;layout=button&amp;action=like&amp;show_faces=false&amp;share=true&amp;height=35&amp;appId=110939712330571" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:20px;width:93px;margin:0 2px;" allowTransparency="true"></iframe><iframe
  src="//platform.twitter.com/widgets/follow_button.html?screen_name=time2hack&show_count=false&show_screen_name=true"
  style="width: 130px; height: 20px;margin:0 2px;"
  allowtransparency="true"
  frameborder="0"
  scrolling="no">
</iframe><!-- Place this tag where you want the widget to render. -->
<div class="g-follow" data-annotation="none" data-height="20" data-href="https://plus.google.com/107779735362438516065" data-rel="publisher"></div></center></div>
		</div>
	</header>
		<!-- Navbar
		================================================== -->
<nav>
	<div id="access">
		<?php 
		/*	Allow screen readers / text browsers to skip the navigation menu and
			get right to the good stuff. */ 
		?>
		
		<div class="skip-link screen-reader-text">
			<a href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentyten' ); ?>">
			<?php _e( 'Skip to content', 't2h' ); ?></a>
		</div>
		
		<div class="navbar navbar-inverse" id="fixed-navbar">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#"><?php bloginfo('name'); ?></a>
				</div>
					<div id="main-nav-wrap" class="navbar-collapse collapse navbar-inverse-collapse">
					<?php /*
						Our navigation menu.  If one isn't filled out, wp_nav_menu falls
						back to wp_page_menu.  The menu assigned to the primary position is
						the one used.  If none is assigned, the menu with the lowest ID is
						used. */
						$defaults = array(
							'container'       => 'div',
							'container_class' => 'clearfix text-center',
							'container_id'    => '',
							'menu_class'      => 'main-nav nav navbar-nav clearfix text-center',
							'menu_id'         => 'main-nav',
							'echo'            => true,
							'fallback_cb'     => 'wp_page_menu',
							'before'          => '',
							'after'           => '',
							'link_before'     => '',
							'link_after'      => '',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'depth'           => 0,
							'walker'          => ''

						);
						wp_nav_menu( $defaults ); 
					?>			
					<!--
					<form class="navbar-form navbar-right">
						<input type="text" class="form-control" placeholder="Search">
					</form>
					-->
				</div><!-- /.nav-collapse -->
			</div><!-- /.container -->
		</div><!-- /.navbar -->
	</div>
</nav>
	
		<div id="main" class="container clearfix">