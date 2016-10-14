<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix'  ); ?>>
	<header class="entry-header">
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php endif; ?>

		<?php if ( is_single() ) : ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php else : ?>
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
		<?php endif; // is_single() ?>


		<div class="meta">
			<p>
			<span class="post-meta">
				<i class="fa fa-user"></i>&nbsp;
				<a href="#author"><?php the_author_link(); ?></a>
			</span>
<?php 
			$hasCode = get_post_meta( get_the_ID(), 'has_code', true );
			$hasSample = get_post_meta( get_the_ID(), 'has_sample', true );
			// check if the custom field has a value
			if( ! empty( $hasCode) && $hasCode == 'Yes' ) {
?>
			<span class="post-meta">
				<abbr title="This post has code"><i class="fa fa-code"></i></abbr>
			</span>
<?php
			} 

			if( ! empty( $hasSample)  && $hasSample == 'Yes') {
?>
			<span class="post-meta">
				<abbr title="Provides Downloadable Code Sample">
					<i class="fa fa-cloud-download"></i>
				</abbr>
			</span>
<?php
			}
?>
			<span class="post-meta">
				<i class="fa fa-comments"></i>&nbsp;<span class="badge"><a href="<?php comments_link(); ?>"><?php comments_number( 'No Responses', 'One Response', '% Responses' ); ?></a></span>
			</span>
			<span class="post-meta">
				<i class="fa fa-calendar"></i>&nbsp;
				<a href="#author"><?php echo esc_attr( human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago' ); ?></a>
			</span>
			<span class="post-meta">
				<i class="fa fa-folder-open"></i>&nbsp;
				<?php the_category( ' &bull; ' ); ?>
			</span>
			
<?php
			if( !is_page() && is_single()){ 
				edit_post_link( __( 'Edit', 't2h' ), '<span class="post-meta edit-link"><i class="fa fa-pencil"></i>&nbsp;', '</span>' );
			} 
?>
			</p>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php 
			if( is_single() ){
				the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 't2h' ) ); 
			}
			else
				the_excerpt();
		?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 't2h' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php
		if( !is_page() && is_single()){ ?>
		<p>
		<?php 
		the_tags( '<span class="post-meta tags"><i class="fa fa-tags"></i>&nbsp;', ', ','</span>' ); ?>
		</p>
		<?php
		} ?>
		<div class="clearfix">
			<h5 class="share-on-title">Share On</h5>
			<a class="share-on-link share-on-twitter" target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo the_title(); ?>&url=<?php echo get_permalink(); ?>&via=time2hack">Twitter</a>
			<a class="share-on-link share-on-facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>">Facebook</a>
			<a class="share-on-link share-on-googleplus" target="_blank" href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>">Google+</a>
			<a class="share-on-link share-on-linkedin" target="_blank" href="https://www.linkedin.com/cws/share?url=<?php echo get_permalink(); ?>&original_referer=<?php echo get_permalink(); ?>&token=&isFramed=false&lang=en_US','winLinkedIn');">LinkedIn</a>
		</div>
		<?php
 		if ( comments_open() && ! is_single() ) : ?>
		<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 't2h' ) . '</span>', __( 'One comment so far', 't2h' ), __( 'View all % comments', 't2h' ) ); ?>
			</div><!-- .comments-link -->
		<?php endif; // comments_open() ?>

		<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->