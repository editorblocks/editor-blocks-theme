<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package    editor-blocks
 * @copyright  Copyright (c) 2018, Danny Cooper
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function editor_blocks_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( is_singular() && ! comments_open() ) {
		$classes[] = 'comments-closed';
	}

	if ( absint( get_post_meta( get_the_ID(), 'editor_blocks_hide_entry_header', true ) ) ) {
		$classes[] = 'hide-entry-header';
	}

	if ( function_exists( 'gutenberg_init' ) ) {
		$classes[] = 'gutenberg-active';
	}

	return $classes;
}
add_filter( 'body_class', 'editor_blocks_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function editor_blocks_pingback_header() {

	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}

}
add_action( 'wp_head', 'editor_blocks_pingback_header' );

/**
 * Replaces the excerpt "Read More" text by a link.
 */
function new_excerpt_more() {
	global $post;
	return '&hellip; <p><a class="moretag" href="' . get_permalink( $post->ID ) . '">' . esc_html__( 'Read the full article', 'editor-blocks' ) . '</a></p>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );
