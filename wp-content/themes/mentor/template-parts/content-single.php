<?php
/**
 * Template part for displaying single post content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mentor
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post post-box'); ?>>
    <?php if ( has_post_thumbnail() ) { ?>
        <div class="entry-media">
            <?php the_post_thumbnail(); ?>
        </div>
    <?php } ?>
    <div class="inner-post">
        <header class="entry-header">

            <?php the_title( '<h2 class="entry-title"><a class="title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
            <?php if ( 'post' === get_post_type() ) : ?>
            <div class="entry-meta">
                <?php if( mentor_get_option( 'post_entry_meta' ) ) { mentor_post_meta(); } ?>
            </div><!-- .entry-meta -->
            <?php endif; ?>

        </header><!-- .entry-header -->

        <div class="entry-summary">

            <?php

                the_content(sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'mentor'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ));

                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'mentor'),
                    'after' => '</div>',
                ));
            ?>

        </div><!-- .entry-content -->
        <div class="entry-footer clearfix">
            <?php mentor_entry_footer(); ?>
        </div>
    </div>
</article>
