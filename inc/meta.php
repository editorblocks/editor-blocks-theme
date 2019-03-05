<?php
/**
 * 'Hide Post/Page Header' Metabox
 *
 * @package    editor-blocks
 * @copyright  Copyright (c) 2018, Danny Cooper
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

add_action( 'load-post.php', 'editor_blocks_post_meta_boxes_setup' );
add_action( 'load-post-new.php', 'editor_blocks_post_meta_boxes_setup' );

/**
 * Hook the metabox functions.
 */
function editor_blocks_post_meta_boxes_setup() {
	/* Add meta boxes on the 'add_meta_boxes' hook. */
	add_action( 'add_meta_boxes', 'editor_blocks_add_post_meta_boxes' );
	/* Save post meta on the 'save_post' hook. */
	add_action( 'save_post', 'editor_blocks_save_meta', 10, 2 );
}

/**
 * Add the meta box.
 */
function editor_blocks_add_post_meta_boxes() {
	add_meta_box(
		'editor-blocks-hide-entry-header', // Unique ID.
		'Hide Entry Header?',              // Title.
		'editor_blocks_render_metabox',    // Callback function.
		null,                              // Admin page.
		'side',                            // Context.
		'core'                             // Priority.
	);
}

/**
 * Render the metabox.
 */
function editor_blocks_render_metabox( $post ) {
	$curr_value = get_post_meta( $post->ID, 'editor_blocks_hide_entry_header', true );
	wp_nonce_field( basename( __FILE__ ), 'editor_blocks_meta_nonce' );
	?>
	<input type="hidden" name="editor-blocks-hide-entry-header-checkbox" value="0"/>
	<input type="checkbox" name="editor-blocks-hide-entry-header-checkbox" id="editor-blocks-hide-entry-header-checkbox" value="1" <?php checked( $curr_value, '1' ); ?> />
	<label for="editor-blocks-hide-entry-header-checkbox">Hide Entry Header</label>
	<?php
}

/**
 * Save the metabox values.
 *
 * @param int    $post_id The current post ID.
 * @param object $post The current post Object.
 */
function editor_blocks_save_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( ! isset( $_POST['editor_blocks_meta_nonce'] ) || ! wp_verify_nonce( $_POST['editor_blocks_meta_nonce'], basename( __FILE__ ) ) ) {
		return;
	}

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
		return;
	}

	/* Get the posted data and sanitize it for use as an HTML class. */
	$form_data = ( isset( $_POST['editor-blocks-hide-entry-header-checkbox'] ) ? $_POST['editor-blocks-hide-entry-header-checkbox'] : '0' );
	update_post_meta( $post_id, 'editor_blocks_hide_entry_header', $form_data );
}
