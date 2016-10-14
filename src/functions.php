<?php
if ( ! function_exists( 't2h_post_nav' ) ) :
function t2h_post_nav(){
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'twentythirteen' ); ?></h1>
		<ul  class="nav-links default-wp-page pager clearfix">
			<li class="previous">
				<?php previous_post_link( '%link', _x( '<span title="%title"><i class="fa fa-chevron-left"></i>  Previous Post</span>', 'Previous post', 't2h' ) ); ?>
				<?php //previous_post_link( '%link', _x( '<i class="fa fa-chevron-left"></i>  %title', 'Previous post', 't2h' ) ); ?>
			</li>
			<li class="next">
				<?php next_post_link( '%link', _x( '<span title="%title">Next Post  <i class="fa fa-chevron-right"></i></span>', 'Next post', 't2h' ) ); ?>
				<?php //next_post_link( '%link', _x( '%title  <i class="fa fa-chevron-right"></i>', 'Next post', 't2h' ) ); ?>
			</li>
		</ul><!-- .nav-links -->
	</nav><!-- .navigation -->	
<?php
}
endif;

if ( ! function_exists( 't2h_scripts_styles' ) ) :
	function t2h_scripts_styles() {
		/*
		 * Adds JavaScript to pages with the comment form to support
		 * sites with threaded comments (when in use).
		 */
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
		
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.0.3' );
		wp_enqueue_style( 'font-awesome', "https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css", array(), '4.5.0' );
		wp_enqueue_style( 'open-sans', 'https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,700,600', array(), '1.0' );
		wp_enqueue_style( 'highlightjs', "//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.2.0/styles/default.min.css", array(), '9.2.0' );
		wp_enqueue_style( 'highlightjs-theme', "http://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.2.0/styles/monokai-sublime.min.css", array(), '9.2.0' );

		// Loads our main stylesheet.
		wp_enqueue_style( 't2h-style', get_stylesheet_uri(), array('bootstrap'), '2013-07-18' );
		

		//Scripts
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'bootstrap', "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js", array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'scroll', get_template_directory_uri() . '/js/jquery-scrolltofixed-min.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'highlightjs', "//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.2.0/highlight.min.js", array(), '9.2.0', true );
		wp_enqueue_script( 't2h-script', get_template_directory_uri() . '/js/script.js', array( 'jquery', 'scroll', 'highlightjs' ), '1.0', true );

		echo "<!-- Hello -->";
	}
	add_action( 'wp_enqueue_scripts', 't2h_scripts_styles' );
endif;


add_action("admin_init", "add_custom_metaboxes");

/**
 * Adds the Metaboxes.
 *
 * @uses this is called as an action to add the custom meta boxes.
 *
 * @since 0.0.1
 *
 * @return void.
 */
function add_custom_metaboxes(){
	add_meta_box("has_code_sample-meta", "Code and Sample", "has_code_sample", "post", "side", "high");
}

/**
 * Metabox for the Public link available of not.
 *
 * @uses Puts the demo of tutorial and code of tutorial meta boxes in the post craetion boxes
 *
 * @since 0.0.1
 *
 * @return void
 */
function has_code_sample(){
	global $post;
	$custom = get_post_custom($post->ID);
	$has_code = $custom["has_code"][0];
	$has_sample = $custom["has_sample"][0];
	$code_link = $custom["code_link"][0];
	$sample_link = $custom["sample_link"][0];
	?>
	<label>Has Code:</label>
	<p><input type="radio" name="has_code" value="Yes"<?php if($has_code == 'Yes') echo 'checked="checked"'; ?> />&nbsp;Yes&nbsp;&nbsp;
	<input type="radio" name="has_code" value="No" <?php if($has_code == 'No') echo 'checked="checked"'; ?>/>&nbsp;No</p>
	<div><input type="text" name="code_link" value="<?php echo $code_link; ?>" style="display: block; width: 100%"></div><br/>
	<label>Provides Sample/Download:</label>
	<p><input type="radio" name="has_sample" value="Yes"<?php if($has_sample == 'Yes') echo 'checked="checked"'; ?> />&nbsp;Yes&nbsp;&nbsp;
	<input type="radio" name="has_sample" value="No" <?php if($has_sample == 'No') echo 'checked="checked"'; ?>/>&nbsp;No</p>
	<div><input type="text" name="sample_link" value="<?php echo $sample_link; ?>" style="display: block; width: 100%"></div>
	<?php
}

add_action('save_post', 'save_details');

/**
 * Return the post URL.
 *
 * @uses Saves the meta values of the has_code and has_sample meta keys for posts.
 *
 * @since 0.0.1
 *
 * @return void
 */
function save_details(){
	global $post;

	update_post_meta($post->ID, "has_code", $_POST["has_code"]);
	update_post_meta($post->ID, "has_sample", $_POST["has_sample"]);
	update_post_meta($post->ID, "sample_link", $_POST["sample_link"]);
	update_post_meta($post->ID, "code_link", $_POST["code_link"]);
	
}


add_filter('the_content', 'add_demo_box', 1);
function add_demo_box($content) {
	$demo_box = '';
	// $custom = get_post_custom($post->ID);
	$code_link = get_post_meta( get_the_ID(), 'code_link', true );
	$sample_link = get_post_meta( get_the_ID(), 'sample_link', true );

	$demo_box .= '<div class="demo-and-download">
		<!-- Demo and Download Link -->';
		if( $code_link != '' ){
			$demo_box .= '<a href="'. $code_link .'" target="_blank" class="btn btn-primary">Demo</a>';
		} if( $sample_link != '' ){ 
			$demo_box .= '<a href="'. $sample_link .'" target="_blank" class="btn btn-primary">Download</a>';
		}
	$demo_box .= '</div>';

	if(is_single() && !is_home()) {
		$content .= $demo_box;
	}
	return $content;
}



/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since 0.0.1
 *
 * @param string $title Default title text for current view.
 * @param string $sep   Optional separator.
 * @return string The filtered title.
 */
function t2h_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 't2h' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 't2h_wp_title', 10, 2 );