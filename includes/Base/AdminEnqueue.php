<?php
namespace BwlPetitionsManager\Base;

/**
 * Class for registering the plugin admin scripts and styles.
 *
 * @package BwlPetitionsManager
 */
class AdminEnqueue {

	/**
	 * Admin script slug.
	 *
	 * @var string $admin_script_slug
	 */
	private $admin_script_slug;

	/**
	 * Constructor.
	 */
	public function __construct() {
		// Frontend script slug.
		// This is required to hook the loclization texts.
		$this->admin_script_slug = 'bptm-admin';
	}

	/**
	 * Register the plugin scripts and styles loading actions.
	 */
	public function register() {
		// for admin.
		add_action( 'admin_enqueue_scripts', [ $this, 'get_the_scripts' ] );
	}
	/**
     * Load the plugin styles and scripts.
     */
	public function get_the_scripts() {
			// Register Data Table Styles.
        wp_enqueue_style(
            'bptm-tipsy',
            BPTM_LIBS_DIR . 'tipsy/styles/bptm-tipsy.css',
            [],
            '1.0.0',
            false
        );
        wp_enqueue_style( 'bptm-jquery-ui-dialog-structure', BPTM_LIBS_DIR . 'jqueryui/flick/jquery-ui.structure.min.css', [], BPTM_PLUGIN_VERSION );
        wp_enqueue_style( 'bptm-jquery-ui-theme', BPTM_LIBS_DIR . 'jqueryui/flick/jquery-ui.theme.min.css', [], BPTM_PLUGIN_VERSION );
        wp_enqueue_style( 'bptm-datatables', BPTM_LIBS_DIR . 'datatable/styles/jquery.dataTables.css', [ 'bptm-jquery-ui-dialog-structure', 'bptm-jquery-ui-theme' ] );
        wp_enqueue_style( $this->admin_script_slug, BPTM_STYLES_ASSETS_DIR . 'admin.css', [], BPTM_PLUGIN_VERSION );

        // Register Data Table & It's required codes.
        wp_enqueue_script( 'bptm-tipsy', BPTM_LIBS_DIR . 'tipsy/scripts/jquery.tipsy.js', [ 'jquery' ], '1.0.0', true );
        wp_enqueue_script( 'bptm-datatable', BPTM_LIBS_DIR . 'datatable/scripts/jquery.dataTables.min.js', [ 'jquery' ], '1.10.12', true );
        wp_enqueue_script( $this->admin_script_slug, BPTM_SCRIPTS_ASSETS_DIR . 'admin.js', [ 'jquery', 'jquery-ui-core', 'jquery-ui-datepicker', 'jquery-ui-dialog', 'bptm-datatable' ], BPTM_PLUGIN_VERSION, true );
		// Load frontend variables used by the JS files.
		$this->get_the_localization_texts();
	}

	/**
	 * Load the localization texts.
	 */
	private function get_the_localization_texts() {

		// Localize scripts.
		// Frontend.
		// Access data: BptmAdminData.version
		wp_localize_script(
            $this->admin_script_slug,
            'BptmAdminData',
            [
				'version' => BPTM_PLUGIN_VERSION,
				'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
			]
		);
	}
}
