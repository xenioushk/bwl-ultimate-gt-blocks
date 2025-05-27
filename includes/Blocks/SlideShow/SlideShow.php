<?php

namespace BUGTB\Blocks\SlideShow;

use BUGTB\Callbacks\Blocks\SlideShow\SlideShowCb;

/**
 * Class SlideShow Block
 *
 * @package BUGTB
 */
class SlideShow {

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
		$slide_show_cb = new SlideShowCb();

		// Block json file
		$json_file = BUGTB_PLUGIN_FILE_PATH . 'build/slideshow';

		register_block_type_from_metadata(
			$json_file,
			[ 'render_callback' => [ $slide_show_cb, 'render_output' ] ]
		);
	}
}
