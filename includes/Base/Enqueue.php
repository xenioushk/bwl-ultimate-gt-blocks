<?php

/**
 * @package bwllpgtb
 */

namespace Xenioushk\Bwllpgtb\Base;

class Enqueue extends BaseController {

	public function register() {

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueueScripts' ] );
	}

	private function thirdPartyStyles() {

		return [];

		// return [
		// "font-awesome" => [
		// "load" => $this->loadFaAssets,
		// "style" => ["font-awesome.min", "v4-shims.min"]
		// ],
		// "owl-carousel" => [
		// "style" => ["owl.carousel"]
		// ],
		// "remodal" => [
		// "load" => $this->load_remodal_assets,
		// "style" => ["remodal", "remodal-default-theme"]
		// ],
		// ];
	}

	private function getAppStyles() {
		// only write the style file name.
		return [
			// 'frontend',
			'style-index',
		];
	}

	private function thirdPartyScripts() {
		return [];
		// Dependency add example.
		// In this example owl carousel is depenedent on two other plugins.
		// "FOLDER_NAME" => [
		// "script" => ["SCRIPT_NAME"],
		// "dep" => "jquery.remodal, smk-accordion.min"
		// "load" => 0 // default 1.
		// ],

		// return [
		// "owl-carousel" => [
		// "script" => ["owl.carousel.min"]
		// ],
		// "remodal" => [
		// "load" => $this->load_remodal_assets,
		// "script" => ["jquery.remodal"]
		// ],
		// "smk-accordion" => [
		// "script" => ["smk-accordion.min"]
		// ],
		// "jquery-tipsy" => [
		// "script" => ["jquery.tipsy"]
		// ]
		// ];
	}

	private function getAppScripts() {
		// only write the script file name
		// key value associative array contains the dependencies.
		// seperate dependencies by comma(,)
		return [
		// 'frontend' => ""
		];
	}

	public function enqueueScripts() {

		// Third Party Styles.
		if ( ! empty( $thirdPartyStyles = $this->thirdPartyStyles() ) ) {
			foreach ( $thirdPartyStyles as $style_folder => $style_info ) {

				$load_style = ( isset( $style_info['load'] ) && $style_info['load'] == 0 ) ? 0 : 1;

				if ( $load_style ) {
					foreach ( $style_info['style'] as $style ) {
						wp_enqueue_style(
							"{$this->plugin_slug}-" . str_replace( '.', '-', $style ),
							"{$this->thirdPartyAssetsDir}{$style_folder}/{$style}.css",
							[],
							$this->plugin_version
						);
					}
				}
			}
		}

		// App Styles.

		if ( ! empty( $appStyles = $this->getAppStyles() ) ) {
			foreach ( $appStyles as $style ) {
				wp_enqueue_style(
					"{$this->plugin_slug}-{$style}",
					"{$this->pluginAssetsDir}{$style}.css",
					[],
					$this->plugin_version
				);
			}
		}

		// RTL Support

		if ( is_rtl() ) {
			wp_enqueue_style(
				"{$this->plugin_slug}-frontend-rtl",
				"{$this->pluginStylesDir}{$style}_rtl.css",
				[],
				$this->plugin_version
			);
		}

		// Third Party Scripts.

		if ( ! empty( $thirdPartyScripts = $this->thirdPartyScripts() ) ) {
			foreach ( $thirdPartyScripts as $script_folder => $script_info ) {

				// Check dependencies.

				$dependency = ( isset( $script_info['dep'] ) && ! empty( $script_info['dep'] ) )
				? $this->default_scripts_dependency . ',' . $script_info['dep'] : $this->default_scripts_dependency;

				$load_script = ( isset( $script_info['load'] ) && $script_info['load'] == 0 ) ? 0 : 1;

				if ( $load_script ) {
					foreach ( $script_info['script'] as $script ) {
						wp_enqueue_script(
							"{$this->plugin_slug}-{$script_folder}",
							"{$this->thirdPartyAssetsDir}{$script_folder}/{$script}.js",
							[ $dependency ],
							$this->plugin_version,
							true
						);
					}
				}
			}
		}

		// App Scripts

		if ( ! empty( $appScripts = $this->getAppScripts() ) ) {
			foreach ( $appScripts as $script => $dependency ) {
				$dependency = ( ! empty( $dependency ) ) ? $this->default_scripts_dependency . ',' . $dependency : $this->default_scripts_dependency;
				wp_enqueue_script(
					"{$this->plugin_slug}-{$script}",
					"{$this->pluginScriptsDir}{$script}.js",
					[ $dependency ],
					$this->plugin_version,
					true
				);
			}
		}

		// Load frontend variables used by the JS files.
		// $this->frontendLocalizeScripts();
	}

	public function frontendLocalizeScripts() {

		// Localize scripts.
		// Frontend.
		// Access data: FrontendData.bkb_app_root
		wp_localize_script(
			$this->plugin_slug . '-frontend',
			$this->plugin_slug . 'FrontendData',
			[
				$this->plugin_slug . '_app_root' => esc_url( get_site_url() ),
			]
		);
	}
}
