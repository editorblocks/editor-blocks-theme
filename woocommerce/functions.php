<?php
/**
 * Editor Blocks WooCommerce functions and definitions
 *
 * @package    editor-blocks
 * @copyright  Copyright (c) 2018, Danny Cooper
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

if ( ! function_exists( 'editor_blocks_wc_checkout_link' ) ) {
	/**
	 * If there are products in the cart, show a checkout link.
	 */
	function editor_blocks_wc_checkout_link() {
		global $woocommerce;

		if ( count( $woocommerce->cart->cart_contents ) > 0 ) :

			echo '<a href="' . esc_url( $woocommerce->cart->get_checkout_url() ) . '" title="' . esc_attr__( 'Checkout', 'editor-blocks' ) . '">' . esc_html__( 'Checkout', 'editor-blocks' ) . '</a>';

		endif;
	}
}
