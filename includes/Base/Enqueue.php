<?php
namespace BUGTB\Base;

/**
 * Class for registering the plugin scripts and styles.
 *
 * @package BUGTB
 */
class Enqueue {

	/**
	 * Frontend script slug.
	 *
	 * @var string $frontend_script_slug
	 */
	private $frontend_script_slug;

	/**
	 * Constructor.
	 */
	public function __construct() {
		// Frontend script slug.
		// This is required to hook the loclization texts.
		$this->frontend_script_slug = 'bptm-frontend';
	}

	/**
	 * Register the plugin scripts and styles loading actions.
	 */
	public function register() {
		// add_action( 'wp_enqueue_scripts', [ $this, 'get_the_styles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'get_the_scripts' ] );
	}

	/**
	 * Load the plugin styles.
	 */
	public function get_the_styles() {

		// Register Styles.

		wp_enqueue_style(
            'bootstrap-social',
            BUGTB_LIBS_DIR . ' bootstrap/styles/bootstrap-social.css',
            [],
        BUGTB_PLUGIN_VERSION );

			wp_enqueue_style(
                'bptm-carousel',
                BUGTB_LIBS_DIR . 'owl.carousel/styles/owl.carousel.css',
                [],
            BUGTB_PLUGIN_VERSION );
		wp_enqueue_style(
			$this->frontend_script_slug,
            BUGTB_STYLES_ASSETS_DIR . 'frontend.css',
            [],
		BUGTB_PLUGIN_VERSION );

		if ( is_rtl() ) {

			wp_enqueue_style(
				'bptm-frontend-rtl',
                BUGTB_STYLES_ASSETS_DIR . 'frontend_rtl.css',
                [],
			BUGTB_PLUGIN_VERSION );
		}
	}

	/**
	 * Load the plugin scripts.
	 */
	public function get_the_scripts() {
		// Register JS
		wp_enqueue_script(
			'swiper-custom',
			BUGTB_LIBS_DIR . 'swiper/scripts/custom.js',
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
            $this->frontend_script_slug,
            'BptmFrontendData',
            [
				'version' => BUGTB_PLUGIN_VERSION,
            ]
		);
	}
}
