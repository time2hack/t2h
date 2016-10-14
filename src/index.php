<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package 	Time to Hack
 * @subpackage 	T2H
 * @since 	T2H 1.0
 */

$paging_nav = true;
get_header(); ?>
<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">
	<?php if ( have_posts() ) : ?>
		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<?php 
			get_template_part( 'content', get_post_format() ); 
		?>
		<?php
			if( is_single() ):
				$paging_nav = false;
				t2h_post_nav();
				comments_template();
			endif;
		?>
		<?php endwhile; ?>
	<?php else : ?>
		<?php get_template_part( 'content', 'none' ); ?>
	<?php endif; ?>
		<?php if( $paging_nav ): ?>
				<!-- Add the pagination functions here. -->
				<ul class="default-wp-page pager clearfix">
					<li class="previous"><?php next_posts_link( 'Older posts' ); ?></li>
					<li class="next"><?php previous_posts_link( 'Newer posts' ); ?></li>
				</ul>
		<?php endif; ?>

	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>