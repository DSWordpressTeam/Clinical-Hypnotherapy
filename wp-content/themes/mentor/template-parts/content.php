<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mentor
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-box'); ?>>
	<div class="post-inner">
		<?php if ( has_post_thumbnail() ) { ?>
		<div class="entry-media post-cat-abs">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail(); ?>
            </a>
        </div>
        <?php } ?>
		<div class="inner-post">
	        <div class="entry-header">

	            <?php the_title( '<h2 class="entry-title"><a class="title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
	            <?php if ( 'post' === get_post_type() ) : ?>
	            <div class="entry-meta">
	            	<?php if( mentor_get_option( 'post_entry_meta' ) ) { mentor_post_meta(); } ?>
	            </div><!-- .entry-meta -->
	            <?php endif; ?>

	        </div><!-- .entry-header -->

	        <div class="entry-summary the-excerpt">

	            <?php the_excerpt(); ?>

	        </div><!-- .entry-content -->
	        <div class="btn-readmore">
	        	<?php if(mentor_get_option('blog_read_more')){ ?><a href="<?php the_permalink(); ?>" class="btn-details"> <?php echo esc_html(mentor_get_option('blog_read_more')); ?></a><?php } ?>
	        </div>
	    </div>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
