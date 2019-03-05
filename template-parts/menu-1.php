<?php
/**
 * Template part for displaying the primary navigation menu.
 *
 * @package    editor-blocks
 * @copyright  Copyright (c) 2018, Danny Cooper
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

?>

<nav id="site-navigation" class="menu-1">
	<div class="wrapper">
		<button class="menu-toggle" aria-controls="site-menu" aria-expanded="false">
			<?php esc_html_e( 'Site Navigation', 'editor-blocks' ); ?>
		</button>

		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'site-menu',
			)
		);
		?>
	</div><!-- .wrapper -->
</nav><!-- .menu-1 -->
