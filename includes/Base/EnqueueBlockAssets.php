<?php
namespace BUGTB\Base;

/**
 * Class for registering the plugin scripts and styles.
 *
 * @package BUGTB
 */
class EnqueueBlockAssets {

	/**
	 * Frontend script slug.
	 *
	 * @var string $block_assets_slug
	 */
	private $block_assets_slug;

	/**
	 * Constructor.
	 */
	public function __construct() {
		// Frontend script slug.
		// This is required to hook the loclization texts.
		$this->block_assets_slug = 'bugtb-assets';
	}

	/**
	 * Register
	 */
	public function register() {

		// enqueue_block_assets ✅ Frontend + ✅ Editor   Shared CSS/JS for both
		// enqueue_block_editor_assets  ❌ Frontend, ✅ Editor only   Editor-only CSS/JS (inspector, controls, preview helpers)

		add_action( 'enqueue_block_assets', [ $this, 'initialize' ] );
		// add_action( 'enqueue_block_editor_assets', [ $this, 'initialize' ] );
	}

	/**
	 * Initialize plugin scripts and styles loading actions.
	 */
	public function initialize() {
		$this->get_the_styles();
		$this->get_the_scripts();
	}



	/**
	 * Load the plugin styles.
	 */
	public function get_the_styles() {
		// Register Styles.

		wp_enqueue_style(
            'swiper-bundle',
            BUGTB_LIBS_DIR . 'swiper/styles/swiper-bundle.min.css',
            [],
        BUGTB_PLUGIN_VERSION );
	}
	/**
	 * Load the plugin scripts.
	 */
	public function get_the_scripts() {

		// Register JS
		wp_enqueue_script(
			'swiper-bundle',
			BUGTB_LIBS_DIR . 'swiper/scripts/swiper-bundle.min.js',
			[],
		BUGTB_PLUGIN_VERSION, true );

		// Load frontend variables used by the JS files.
		// $this->get_the_localization_texts();
	}

	/**
	 * Load the localization texts.
	 */
	private function get_the_localization_texts() {

		// Localize scripts.
		// Frontend.
		// Access data: BptmFrontendData.version
		wp_localize_script(
            $this->block_assets_slug,
            'BptmFrontendData',
            [
				'version' => BUGTB_PLUGIN_VERSION,
            ]
		);
	}
}
