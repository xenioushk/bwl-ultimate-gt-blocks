<?php
namespace BUGTB\Helpers;

/**
 * Class for plugin constants.
 *
 * @package BUGTB
 */
class PluginConstants {

	/**
     * Static property to hold plugin options.
     *
     * @var array
     */
    public static $plugin_options = [];

		/**
		 * Static property to gt blocks.
		 *
		 * @var array
		 */
	public static $gt_blocks = [];

    /**
     * Initialize the plugin options.
     */
    public static function init() {

        // self::$plugin_options = get_option( 'petitions_options' );
    }

		/**
         * Get the absolute path to the plugin root.
         *
         * @return string
         * @example wp-content/plugins/petitions-manager/
         */
    public static function get_plugin_path(): string {
        return dirname( dirname( __DIR__ ) ) . '/';
    }


    /**
     * Get the plugin URL.
     *
     * @return string
     * @example http://appealwp.local/wp-content/plugins/petitions-manager/
     */
    public static function get_plugin_url(): string {
		return plugin_dir_url( self::get_plugin_path() . BUGTB_PLUGIN_ROOT_FILE );
	}

	/**
	 * Register the plugin constants.
	 */
	public static function register() {
		self::init();
		self::set_base_constants();
		self::set_paths_dir_constants();
		self::set_assets_constants();
		self::set_gt_blocks_constants();
		// self::set_updater_constants();
	}

	/**
	 * Set the plugin GT blocks constants.
	 */
	public static function set_gt_blocks_constants() {
		self::$gt_blocks = [
			'intro',
			'about',
			'letter',
			'image',
			'submit-to',
			'result',
			'form',
			'categories',
		];
	}

	/**
	 * Set the plugin base constants.
	 */
	private static function set_base_constants() {
		define( 'BUGTB_PLUGIN_VERSION', '1.0.0' );
		define( 'BUGTB_PLUGIN_TITLE', 'BWL Ultimate Gutenberg Blocks' );
		define( 'BUGTB_PLUGIN_FOLDER', 'bwl-ultimate-gt-blocks' );
		define( 'BUGTB_CURRENT_VERSION', BUGTB_PLUGIN_VERSION );
	}

	/**
	 * Set the plugin paths constants.
	 */
	private static function set_paths_dir_constants() {
		define( 'BUGTB_PLUGIN_ROOT_FILE', 'bwl-ultimate-gt-blocks.php' );
		define( 'BUGTB_PLUGIN_DIR', self::get_plugin_path() );
		define( 'BUGTB_PLUGIN_FILE_PATH', BUGTB_PLUGIN_DIR );
		define( 'BUGTB_PLUGIN_URL', self::get_plugin_url() );
	}

	/**
	 * Set the plugin assets constants.
	 */
	private static function set_assets_constants() {
		define( 'BUGTB_BUILD_DIR', BUGTB_PLUGIN_URL . 'build/' );
		define( 'BUGTB_STYLES_ASSETS_DIR', BUGTB_PLUGIN_URL . 'assets/styles/' );
		define( 'BUGTB_SCRIPTS_ASSETS_DIR', BUGTB_PLUGIN_URL . 'assets/scripts/' );
		define( 'BUGTB_LIBS_DIR', BUGTB_PLUGIN_URL . 'libs/' );
	}
	/**
	 * Set the updater constants.
	 */
	private static function set_updater_constants() {

		// Only change the slug.
		$slug        = 'bugtb/notifier_bugtb.php';
		$updater_url = "https://projects.bluewindlab.net/wpplugin/zipped/plugins/{$slug}";

		define( 'BUGTB_UPDATER_URL', $updater_url ); // phpcs:ignore

		define( 'BUGTB_UPDATER_SLUG', BUGTB_PLUGIN_FOLDER . '/' . BUGTB_PLUGIN_ROOT_FILE ); // phpcs:ignore
		define( 'BUGTB_PETITIONS_PLUGIN_PATH', BUGTB_PLUGIN_DIR );
	}
}
