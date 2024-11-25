<?php

namespace Xenioushk\Bwllpgtb\Base;

/**
 * AdminEnqueue handles register scripts and styles.
 *
 * @package bwllpgtb
 */
class AdminEnqueue extends BaseController {

	/**
	 * Register the required actions and hooks.
	 *
	 * @return void
	 */
	public function register() {
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueueScripts' ] );
	}

	/**
	 * Enqueues the scripts.
	 *
	 * @return void
	 */
	public function enqueueScripts() {
		wp_enqueue_style( $this->plugin_slug . '-admin', $this->pluginStylesDir . 'admin.css', [], $this->plugin_version );

		// RTL support

		wp_enqueue_script( $this->plugin_slug . '-admin', $this->pluginScriptsDir . 'admin.js', [ 'jquery' ], $this->plugin_version, true );

		// Load translated texts using by the js fils.
		$this->adminLocalizeScripts();

		// Check point To Load JS & CSS files in admin.
		// We only load Plugin required JS & CSS files where it acutally required.

		$currentPostType = '';

		if ( isset( $_GET['post_type'] ) && $_GET['post_type'] == $this->plugin_post_type ) {

			$currentPostType = $this->plugin_post_type;
		} elseif ( isset( $_GET['post'] ) && get_post_type( $_GET['post'] ) === $this->plugin_post_type ) {

			$currentPostType = $this->plugin_post_type;
		} else {

			$currentPostType = '';
		}

		// Load Font-Awesome only in KB Pages.

		if ( $currentPostType == $this->plugin_post_type ) {
			wp_enqueue_style( $this->plugin_slug . '-fa-admin', $this->thirdPartyAssetsDir . 'font-awesome/font-awesome.min.css', [], $this->plugin_version );
			wp_enqueue_style( $this->plugin_slug . '-fa-v4-admin', $this->thirdPartyAssetsDir . 'font-awesome/v4-shims.min.css', [], $this->plugin_version );
		}

		// Required JS & CSS Files For KB Shortcode Button.
		wp_enqueue_style( 'bkb-shortcode-editor-multiple-select-style',
			$this->thirdPartyAssetsDir . 'tinymce/css/multiple-select.css',
        [], $this->plugin_version);
		wp_enqueue_script( 'bkb-admin-mutiple-select-script',
			$this->thirdPartyAssetsDir . 'tinymce/js/jquery.multiple.select.js',
			[ 'jquery', 'jquery-ui-core', 'jquery-ui-sortable', 'jquery-ui-draggable', 'jquery-ui-droppable' ],
        $this->plugin_version, true);

		// Load live Font Awesome icon changes only in KB pages.

		if ( $currentPostType == $this->plugin_post_type || get_post_type() == 'product' ) {

			wp_enqueue_script( 'media-upload' );
			wp_enqueue_script( 'thickbox' );
			wp_enqueue_style( 'thickbox' );
		}

		if ( is_rtl() ) {
			wp_enqueue_style( 'bkbm-admin-rtl-styles',
				$this->pluginStylesDir . 'admin_rtl.css',
				[],
            $this->plugin_version);
		}
	}

	/**
	 * Admin scripts localization.
	 *
	 * @return void
	 */
	public function adminLocalizeScripts() {

		// Backend.
		// Access data: bkbmAdminData.bkb_text_loading
		wp_localize_script(
			$this->plugin_slug . '-admin', // admin script.
			$this->plugin_slug . 'AdminData',
			[
				'plugin_url'           => $this->plugin_url,
				'bkb_text_loading'     => esc_attr__( 'Loading .....', 'bwllpgtb' ),
				'bkb_text_saving'      => esc_attr__( 'Saving .....', 'bwllpgtb' ),
				'bkb_text_saved'       => esc_attr__( 'Saved .....', 'bwllpgtb' ),
				'bkb_string_featured'  => esc_attr__( 'Featured', 'bwllpgtb' ),
				'bkb_string_popular'   => esc_attr__( 'Popular', 'bwllpgtb' ),
				'bkb_string_recent'    => esc_attr__( 'Recent', 'bwllpgtb' ),
				'bkb_pvc_required_msg' => esc_attr__( 'Purchase code is required!', 'bwllpgtb' ),
				'bkb_pvc_success_msg'  => esc_attr__( 'Purchase code verified. Reloading window in 3 seconds.', 'bwllpgtb' ),
				'bkb_pvc_failed_msg'   => esc_attr__( 'Unable to verify purchase code. Please try again or contact support team.', 'bwllpgtb' ),
				'bkb_pvc_remove_msg'   => esc_attr__( 'Are you sure to remove the license info?', 'bwllpgtb' ),
				'bkb_pvc_removed_msg'  => esc_attr__( 'Purchase code removed. Reloading window in 3 seconds.', 'bwllpgtb' ),
				'tiny_mce_btn_cmd'     => $this->plugin_slug,
				'product_id'           => $this->pluginItemId,
				'installation'         => get_option( $this->pluginInstallationTag ),
			]
		);
	}
}
