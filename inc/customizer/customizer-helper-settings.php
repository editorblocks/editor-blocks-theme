<?php
/**
 * Example implementation of the 'Customizer Helper'.
 *
 * @link       https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package    customizer-helper
 * @copyright  Copyright (c) 2018, Danny Cooper
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version    1.0.0
 */

/**
 * Load the helper class.
 */
if ( file_exists( dirname( __FILE__ ) . '/class-customizer-helper.php' ) ) {
	require_once dirname( __FILE__ ) . '/class-customizer-helper.php';
}

/**
 * Defines customizer settings
 */
function customizer_helper_settings() {

	// Stores all the panels to be added.
	$panels = array();

	// Stores all the sections to be added.
	$sections = array();

	// Stores all the settings that will be added.
	$settings = array();

	$section = 'header_image';

	$settings['header-background-height'] = array(
		'id'       => 'header-background-height',
		'label'    => esc_html__( 'Header Height (px)', 'editor-blocks' ),
		'section'  => $section,
		'type'     => 'number',
		'priority' => 1,
		'default'  => '',
	);

	$settings['header-background-repeat'] = array(
		'id'       => 'header-background-repeat',
		'label'    => esc_html__( 'Header Background Repeat', 'editor-blocks' ),
		'section'  => $section,
		'type'     => 'radio',
		'priority' => 12,
		'choices'  => array(
			'no-repeat' => esc_html__( 'No Repeat', 'editor-blocks' ),
			'repeat'    => esc_html__( 'Tile', 'editor-blocks' ),
			'repeat-x'  => esc_html__( 'Tile Horizontally', 'editor-blocks' ),
			'repeat-y'  => esc_html__( 'Tile Vertically', 'editor-blocks' ),
		),
		'default'  => 'no-repeat',
	);

	$settings['header-background-size'] = array(
		'id'       => 'header-background-size',
		'label'    => esc_html__( 'Header Background Size', 'editor-blocks' ),
		'section'  => $section,
		'type'     => 'radio',
		'priority' => 12,
		'choices'  => array(
			'initial' => esc_html__( 'Normal', 'editor-blocks' ),
			'cover'   => esc_html__( 'Cover', 'editor-blocks' ),
			'contain' => esc_html__( 'Contain', 'editor-blocks' ),
		),
		'default'  => 'initial',
	);

	$settings['header-background-position'] = array(
		'id'       => 'header-background-position',
		'label'    => esc_html__( 'Header Background Position', 'editor-blocks' ),
		'section'  => $section,
		'type'     => 'select',
		'priority' => 13,
		'choices'  => array(
			'left'   => esc_html__( 'Left', 'editor-blocks' ),
			'center' => esc_html__( 'Center', 'editor-blocks' ),
			'right'  => esc_html__( 'Right', 'editor-blocks' ),
		),
		'default'  => 'center',
	);

	$settings['header-background-attachment'] = array(
		'id'       => 'header-background-attachment',
		'label'    => esc_html__( 'Scroll with Page', 'editor-blocks' ),
		'section'  => $section,
		'type'     => 'checkbox',
		'priority' => 14,
	);

	// Adds the panels to the $settings array.
	$settings['panels'] = $panels;

	// Adds the sections to the $settings array.
	$settings['sections'] = $sections;

	$customizer_helper = Customizer_Helper::Instance();
	$customizer_helper->add_settings( $settings );

}
add_action( 'init', 'customizer_helper_settings' );
