<?php
/**
 * Editor Blocks Welcome Page.
 *
 * @package editor-blocks
 */

/**
 * Create the editor blocks welcome page.
 */
class Editor_Blocks_Theme_Welcome {

	/**
	 * Start up
	 */
	public function __construct() {
			add_action( 'admin_menu', array( $this, 'add_theme_page' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );

	}

	/**
	 * Add options page
	 */
	public function add_theme_page() {
			// This page will be under "Settings".
			add_theme_page(
				'Editor Blocks Theme Help',
				'Editor Blocks',
				'manage_options',
				'editor-blocks-theme',
				array( $this, 'create_admin_page' )
			);
	}

	/**
	 * Add options page
	 */
	public function enqueue() {
		wp_enqueue_style( 'editor-blocks-theme-welcome', get_template_directory_uri() . '/admin/style.css', false, '1.0.0' );
	}

	/**
	 * Options page callback
	 */
	public function create_admin_page() {

		$eb_install_url = wp_nonce_url(
			add_query_arg(
				array(
					'action' => 'install-plugin',
					'plugin' => 'editor-blocks',
				),
				admin_url( 'update.php' )
			),
			'install-plugin_editor-blocks'
		);

		$eb_activate_url = wp_nonce_url(
			add_query_arg(
				array(
					'action' => 'activate',
					'plugin' => 'editor-blocks/plugin.php',
				),
				admin_url( 'plugins.php' )
			),
			'activate-plugin_editor-blocks/plugin.php'
		);

		?>
			<div class="eb-wrap">
				<div class="eb-sidebar">
					<div class="eb-sidebar__header">
						<h2><?php esc_html_e( 'Quickstart', 'editor-blocks' ); ?></h2>
					</div>
					<div class="eb-sidebar__inner">
						<div class="eb-sidebar__plugin">
							<h3><?php esc_html_e( 'Editor Blocks Plugin', 'editor-blocks' ); ?></h3>
							<p><?php esc_html_e( 'We\'ve built a companion theme to display Editor Blocks in the most beautiful way.', 'editor-blocks' ); ?></p>
							<?php
							if ( function_exists( 'editor_blocks_assets' ) ) {
								echo '<strong>&#10004; ' . esc_html__( 'Plugin is active.', 'editor-blocks' ) . '</strong>';
							} elseif ( array_key_exists( 'editor-blocks/plugin.php', get_plugins() ) && ! is_plugin_active( 'editor-blocks/plugin.php' ) ) {
								echo '<a class="eb-button" href="' . esc_url( $eb_activate_url ) . '">' . esc_html__( 'Activate Plugin', 'editor-blocks' ) . '</a>';
							} else {
								echo '<a class="eb-button" href="' . esc_url( $eb_install_url ) . '">' . esc_html__( 'Install Plugin', 'editor-blocks' ) . '</a>';
							}
							?>
						</div>
					</div>
				</div>
				<div class="eb-content">
					<div class="eb-content__header">
						<h1><?php esc_html_e( 'Editor Blocks Theme Help', 'editor-blocks' ); ?></h1>
					</div>
					<div class="eb-content__inner">
						<h3><?php esc_html_e( 'Thank you!', 'editor-blocks' ); ?></h3>

						<p><?php esc_html_e( 'Thank you for installing the Editor Blocks theme. We\'ve created this page to help you get up and running as quickly as possible.', 'editor-blocks' ); ?></p>

						<h3><?php esc_html_e( 'Demo Content', 'editor-blocks' ); ?></h3>

						<p><?php esc_html_e( 'To help you get a feel for the theme, we\'ve created demo content you can import into your site.', 'editor-blocks' ); ?>
						<a href="https://editorblockswp.com/demo-content"><?php esc_html_e( 'Click here to learn how to import the demo content.', 'editor-blocks' ); ?></a>
						</p>

						<h3><?php esc_html_e( 'What is Gutenberg?', 'editor-blocks' ); ?></h3>

						<p><?php esc_html_e( 'Gutenberg is WordPress\' next evolution of the text editor. In Gutenberg, content is divided into \'Blocks\'. A block can be a paragraph, an image, a video or anything else you can imagine. Blocks can be arranged using the drag and drop interface.', 'editor-blocks' ); ?></p>

						<p><?php esc_html_e( 'By default Gutenberg comes packaged with 20 essential blocks, these include headings, audio, video quotes, lists, tables, custom HTML and more.', 'editor-blocks' ); ?></p>

						<h3><?php esc_html_e( 'What is Editor Blocks?', 'editor-blocks' ); ?></h3>

						<p><?php esc_html_e( 'Editor Blocks is a collection of blocks that expands on the basics Gutenberg provides.', 'editor-blocks' ); ?></p>

						<h3><?php esc_html_e( 'What is the Editor Blocks Theme?', 'editor-blocks' ); ?></h3>

						<p><?php esc_html_e( 'The Editor Blocks companion theme is optimised to display Editor Blocks in the best way possible. Many themes have a narrow page width that doesn\'t work well with wide blocks such as the Pricing Table block.', 'editor-blocks' ); ?></p>

						<p><?php esc_html_e( 'Both the Editor Blocks plugin and theme work well independently, but together they are even better.', 'editor-blocks' ); ?></p>

						<h3><?php esc_html_e( 'How to use Editor Blocks', 'editor-blocks' ); ?></h3>

						<p><?php esc_html_e( 'Once you have Gutenberg and the Editor Blocks plugin active, creating pages using blocks is simple.', 'editor-blocks' ); ?></p>

						<p><?php esc_html_e( 'There are two ways to insert Gutenberg blocks:', 'editor-blocks' ); ?></p>

						<p><?php esc_html_e( 'The first way is to click the + sign and then choose a block from the popup that appears. Editor Blocks has it\'s own category in the popup so you can easily find them.', 'editor-blocks' ); ?></p>

						<?php $image_src = get_template_directory_uri() . '/admin/images/'; ?>

						<a target="_blank" href="<?php echo esc_url( $image_src . 'insert1.gif' ); ?>"><img src="<?php echo esc_url( $image_src . 'insert1.gif' ); ?>" /></a>

						<p><?php esc_html_e( 'A quicker way to insert a block is to place your cursor on the page and then type a forward slash followed by the first letters of the block you want to use,  for example /pri would bring up the pricing table block. This method is a lot faster when you are crafting a page.', 'editor-blocks' ); ?></p>

						<a target="_blank" href="<?php echo esc_url( $image_src . 'insert2.gif' ); ?>"><img src="<?php echo esc_url( $image_src . 'insert2.gif' ); ?>" /></a>

						<p class="eb-tip"><?php esc_html_e( 'Quick Tip: The \'Wrapper\' block allows you to place any other block inside of it. That means you can easily add a background, padding and margins to any block.', 'editor-blocks' ); ?></p>
					</div>
				</div>
				<div class="eb-blocks">
					<div class="eb-block">
						<img class="eb-block__image" src="<?php echo esc_url( $image_src . 'code.png' ); ?>">
						<h4><?php esc_html_e( 'Wrapper Block', 'editor-blocks' ); ?></h4>
						<p class="feature__text"><?php esc_html_e( 'Add backgrounds and padding to any block.', 'editor-blocks' ); ?></p>
						<p><a target="_blank" href="https://editorblockswp.com/gutenberg-wrapper-block/"><?php esc_html_e( 'Learn More', 'editor-blocks' ); ?></a></p>
					</div>
					<div class="eb-block eb-block-odd">
						<img class="eb-block__image" src="<?php echo esc_url( $image_src . 'wallet.png' ); ?>">
						<h4><?php esc_html_e( 'Pricing Table Block', 'editor-blocks' ); ?></h4>
						<p class="feature__text"><?php esc_html_e( 'Beautiful 2, 3, 4 or 5 column pricing tables.', 'editor-blocks' ); ?></p>
						<p><a target="_blank" href="https://editorblockswp.com/gutenberg-pricing-table-block/"><?php esc_html_e( 'Learn More', 'editor-blocks' ); ?></a></p>
					</div>
					<div class="eb-block">
						<img class="eb-block__image" src="<?php echo esc_url( $image_src . 'user-add.png' ); ?>">
						<h4><?php esc_html_e( 'Team Block', 'editor-blocks' ); ?></h4>
						<p class="feature__text"><?php esc_html_e( 'Proudly display your team members.', 'editor-blocks' ); ?></p>
						<p><a target="_blank" href="https://editorblockswp.com/gutenberg-team-members-block/"><?php esc_html_e( 'Learn More', 'editor-blocks' ); ?></a></p>
					</div>
					<div class="eb-block eb-block-last eb-block-odd">
						<img class="eb-block__image" src="<?php echo esc_url( $image_src . 'photo.png' ); ?>">
						<h4><?php esc_html_e( 'Hero Block', 'editor-blocks' ); ?></h4>
						<p class="feature__text"><?php esc_html_e( 'Add a stunning hero header image to your page. ', 'editor-blocks' ); ?></p>
						<p><a target="_blank" href="https://editorblockswp.com/gutenberg-hero-block/"><?php esc_html_e( 'Learn More', 'editor-blocks' ); ?></a></p>
					</div>
					<div class="eb-block">
						<img class="eb-block__image" src="<?php echo esc_url( $image_src . 'badge.png' ); ?>">
						<h4><?php esc_html_e( 'Testimonial Block', 'editor-blocks' ); ?></h4>
						<p class="feature__text"><?php esc_html_e( 'Show of your client testimonials with this beautiful block.', 'editor-blocks' ); ?></p>
						<p><a target="_blank" href="https://editorblockswp.com/gutenberg-testimonial-block/"><?php esc_html_e( 'Learn More', 'editor-blocks' ); ?></a></p>
					</div>
					<div class="eb-block eb-block-odd">
						<img class="eb-block__image" src="<?php echo esc_url( $image_src . 'announcement.png' ); ?>">
						<h4><?php esc_html_e( 'Callout Block', 'editor-blocks' ); ?></h4>
						<p class="feature__text"><?php esc_html_e( 'Draw your visitors attention using a inline callout.', 'editor-blocks' ); ?></p>
						<p><a target="_blank" href="https://editorblockswp.com/gutenberg-callout-block/"><?php esc_html_e( 'Learn More', 'editor-blocks' ); ?></a></p>
					</div>
					<div class="eb-block">
						<img class="eb-block__image" src="<?php echo esc_url( $image_src . 'store-front.png' ); ?>">
						<h4><?php esc_html_e( 'Brands Block', 'editor-blocks' ); ?></h4>
						<p class="feature__text"><?php esc_html_e( 'Output a list of brand images, perfect for displaying your clients.', 'editor-blocks' ); ?></p>
						<p><a target="_blank" href="https://editorblockswp.com/gutenberg-brands-block/"><?php esc_html_e( 'Learn More', 'editor-blocks' ); ?></a></p>
					</div>
					<div class="eb-block eb-block-last eb-block-odd">
						<img class="eb-block__image" src="<?php echo esc_url( $image_src . 'list-bullet.png' ); ?>">
						<h4><?php esc_html_e( 'Features Block', 'editor-blocks' ); ?></h4>
						<p class="feature__text"><?php esc_html_e( 'Display an organised list of features, just like this one!', 'editor-blocks' ); ?></p>
						<p><a target="_blank" href="https://editorblockswp.com/gutenberg-features-block/"><?php esc_html_e( 'Learn More', 'editor-blocks' ); ?></a></p>
					</div>
					<div class="eb-block eb-block-empty">
					</div>
					<div class="eb-block eb-block-odd">
						<img class="eb-block__image" src="<?php echo esc_url( $image_src . 'arrow-thin-right.png' ); ?>">
						<h4><?php esc_html_e( 'Horizontal Feature', 'editor-blocks' ); ?></h4>
						<p class="feature__text"><?php esc_html_e( 'Highlight a key feature using this horizontal display.', 'editor-blocks' ); ?></p>
						<p><a target="_blank" href="https://editorblockswp.com/gutenberg-horizontal-feature-block/"><?php esc_html_e( 'Learn More', 'editor-blocks' ); ?></a></p>
					</div>
					<div class="eb-block">
						<img class="eb-block__image" src="<?php echo esc_url( $image_src . 'arrow-thin-down.png' ); ?>">
						<h4><?php esc_html_e( 'Vertical Feature', 'editor-blocks' ); ?></h4>
						<p class="feature__text"><?php esc_html_e( 'Highlight a key feature using this vertical display.', 'editor-blocks' ); ?></p>
						<p><a target="_blank" href="https://editorblockswp.com/gutenberg-vertical-feature-block/"><?php esc_html_e( 'Learn More', 'editor-blocks' ); ?></a></p>
					</div>
					<div class="eb-block eb-block-last eb-block-odd eb-block-empty">

					</div>
				</div>
			</div>
			<?php
	}
}

$editor_blocks_theme_welcome = new Editor_Blocks_Theme_Welcome();
