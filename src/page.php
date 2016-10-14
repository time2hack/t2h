<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

  <div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">

      <?php /* The loop */ ?>
      <?php while ( have_posts() ) : the_post(); 

      ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <header class="entry-header">
            <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
            <div class="entry-thumbnail">
              <?php the_post_thumbnail(); ?>
            </div>
            <?php endif; ?>

            <h1 class="entry-title"><?php the_title(); ?></h1>
          </header><!-- .entry-header -->

          <div class="entry-content">
          <?php 
            the_content(); 
          
            wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 't2h' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); 

            if( the_title('', '', false) == 'Downloads'){
              $args = array(
                'posts_per_page'   => -1,
                'offset'           => 0,
                'orderby'          => 'date',
                'order'            => 'DESC',
                'meta_query'     => array (
                            array (
                              'key' => 'has_code',
                              'value' => 'Yes',
                              'compare' => 'IN'
                            ),
                            array (
                              'key' => 'has_sample',
                              'value' => 'Yes',
                              'compare' => 'IN'
                            )
                          ),
                'post_type'        => 'post',
                'post_status'      => 'publish',
                'suppress_filters' => true 
              );

              $posts_array = get_posts( $args );
              // $args = array(
              //    'meta_query' => array(
              //      array(
              //        'key' => 'has_code',
              //        'value' => 'Yes'
              //      ),
              //      array(
              //        'key' => 'has_sample',
              //        'value' => 'Yes'
              //      ),
              //    )
              //  )
              // $posts_ = query_posts($args);
              echo "Posts found ". count( $posts_array ) ."<!--  -->";
              // wp_reset_query();
              if ( count( $posts_array ) > 0 ) { 
                foreach ( $posts_array as $post ) { 
                  // print_r($post);
                  
                  ?>
                  <article id="post-<?php the_ID(); ?>" class="callout">
                    <header class="entry-header">
                      
                      
                      <h4 class="entry-title">
                        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                      </h4>
                      

                      <div class="clearfix">
                        <?php 
                        $hasCode = get_post_meta( get_the_ID(), 'has_code', true );
                        $hasSample = get_post_meta( get_the_ID(), 'has_sample', true );
                        // check if the custom field has a value
                        if( ! empty( $hasCode) && $hasCode == 'Yes' ) { ?>
                          <a href="#" class="btn btn-info pull-right btn-sm" title="This post has code"><i class="fa fa-code"></i> Demo</a>
                        <?php
                        } 
                        if( ! empty( $hasSample)  && $hasSample == 'Yes') { ?>
                          <a href="#" class="btn btn-info pull-right btn-sm" title="Provides Downloadable Code Sample"><i class="fa fa-cloud-download"></i> Download</a>
                        <?php } ?>
                        <?php
                        if( !is_page() && is_single()){ 
                          edit_post_link( __( 'Edit', 't2h' ), '<span class="post-meta edit-link"><i class="fa fa-pencil"></i>&nbsp;', '</span>' );
                        } 
                        ?>
                      </div><!-- .entry-meta -->
                    </header><!-- .entry-header -->
                  </article>
                  <?php
                  
                }
              }
            }
            ?>
        </div><!-- .entry-content -->

          <footer class="entry-meta">
            <?php //edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); echo '<!-- Hello -->';?>
          </footer><!-- .entry-meta -->
        </article><!-- #post -->

        <?php //comments_template(); ?>
      <?php endwhile; ?>

    </div><!-- #content -->
  </div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>