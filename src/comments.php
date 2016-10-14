<?php

/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 't2h' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<ul class="comment-list col-lg-12 col-md-12">
			<?php
				wp_list_comments( array(
					'style'       => 'div',
					'short_ping'  => true,
					'avatar_size' => 36,
				) );
			?>
		</ul><!-- .comment-list -->
		<div class="clearfix"></div>
		<?php
			// Are there comments to navigate through?
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>

		<nav class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'twentythirteen' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'twentythirteen' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'twentythirteen' ) ); ?></div>
		</nav><!-- .comment-navigation -->
		<?php endif; // Check for comment navigation ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.' , 'twentythirteen' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

<?php $comment_args = array( 'title_reply'=>'Got Something To Say:',

//'id_submit'=>'submit" class="btn btn-primary',

'fields' => apply_filters( 'comment_form_default_fields', array(

'author' => '<span class="comment-form-author">' . '<label for="author" class="sr-only">' . __( 'Your Good Name' ) . ( $req ? '<span>*</span>' : '' ) . '</label> ' .
        '<input id="author" name="author" type="text" class="form-control" placeholder="' . __( 'Your Good Name' ) . ( $req ? '*' : '' ) .'" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></span>',   

    'email'  => '<span class="comment-form-email">' .

                '<label for="email" class="sr-only">' . __( 'Your Email Please' ) . ( $req ? '<span>*</span>' : '' ) . '</label> ' .

                

                '<input id="email" name="email" type="text" class="form-control" placeholder="' . __( 'Your Email Please' ) . ( $req ? '*' : '' ) .'" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />'.'</span>',

    'url'    => '<span class="comment-form-url">' .

                '<label for="url" class="sr-only">' . __( 'Your Website' ) . '</label> ' .

                '<input id="url" name="url" type="text" class="form-control"  placeholder="' . __( 'Your Website' ) . '" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" size="30"  />'.'</span>')),

    'comment_field' => '<p>' .

                '<label for="comment" class="sr-only">' . __( 'Let us know what you have to say:' ) . '</label>' .

                '<textarea id="comment" name="comment" placeholder="' . __( 'Let us know what you have to say' ) . '" cols="45" rows="5" class="form-control" aria-required="true"></textarea>' .

                '</p>',

    'comment_notes_after' => '',

);

//comment_form($comment_args);
 ?>
	<div><?php 
ob_start(); 
comment_form($comment_args); 
$form = ob_get_clean(); 
$form = str_replace('class="comment-form"','class="comment-form my-class"', $form);
echo str_replace('id="submit"','id="submit" class="btn btn-primary"', $form);
?></div>
</div><!-- #comments -->