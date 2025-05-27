<?php

/**
 * Plugin Name:     BWL Ultimate Gutenberg Blocks
 * Description:       BWL Ultimate Gutenberg Blocks
 * Requires at least: 6.0
 * Requires PHP:      8.0
 * Version:             1.0.0
 * Author:            Mahbub Alam Khan
 * License:           GPL-2.0-or-later
 * License URI:      https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:     bwl-ultimate-gt-blocks
 *
 * @package           BUGTB
 */


namespace BUGTB;

// security check.
defined( 'ABSPATH' ) || die( 'Unauthorized access' );

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require_once __DIR__ . '/vendor/autoload.php';
}

define( 'BWL_ULTIMATE_GT_BLOCKS_DIR', __DIR__ );

use BUGTB\Base\Activate;
use BUGTB\Base\Deactivate;


/**
 * Function to handle the activation of the plugin.
 *
 * @return void
 */
    function activate_plugin() { // phpcs:ignore
	global $wpdb;
	$activate = new Activate( $wpdb );
	$activate->activate();
}

	/**
	 * Function to handle the deactivation of the plugin.
	 *
	 * @return void
	 */
	function deactivate_plugin() { // phpcs:ignore
	Deactivate::deactivate();
}

	register_activation_hook( __FILE__, __NAMESPACE__ . '\\activate_plugin' );
	register_deactivation_hook( __FILE__, __NAMESPACE__ . '\\deactivate_plugin' );

	/**
	 * Function to handle the initialization of the plugin.
	 *
	 * @return void
	 */
function init_bugtb() {

	if ( class_exists( 'BUGTB\\Init' ) ) {

		Init::register_services();
	}
}

	add_action( 'init', __NAMESPACE__ . '\\init_bugtb' );
