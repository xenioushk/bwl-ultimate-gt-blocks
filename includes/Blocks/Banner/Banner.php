<?php

namespace BUGTB\Blocks\Banner;

use BUGTB\Callbacks\Blocks\Banner\BannerCb;

/**
 * Class Banner Block
 *
 * @package BUGTB
 */
class Banner {

	/**
	 * Register
	 */
	public function register() {
		$this->register_block();
	}

	/**
	 * Register block
	 */
	public function register_block() {

		// Initiate the block callback class
		$banner_cb = new BannerCb();

		// Block json file
		$json_file = BUGTB_PLUGIN_FILE_PATH . 'build/banner';

		register_block_type_from_metadata(
			$json_file,
			[ 'render_callback' => [ $banner_cb, 'render_output' ] ]
		);
	}
}
