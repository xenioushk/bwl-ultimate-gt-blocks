<?php
namespace BwlPetitionsManager\Base;

use Xenioushk\BwlPluginApi\Api\PluginUpdate\WpAutoUpdater;

/**
 * Class for plugin update.
 *
 * @since: 1.1.0
 * @package BwlPetitionsManager
 */
class PluginUpdate extends BaseController {

  	/**
     * Register the plugin text domain.
     */
	public function register() {
		add_action( 'admin_init', [ $this, 'check_for_the_update' ] );
	}

	/**
     * Check for the plugin update.
     */
	public function check_for_the_update() {

		new WpAutoUpdater( BPTM_PLUGIN_VERSION, BPTM_UPDATER_URL, BPTM_UPDATER_SLUG );
	}
}
