<?php

namespace BUGTB\Blocks\Button;

use BUGTB\Callbacks\Blocks\Button\ButtonCb;

/**
 * Class Button
 *
 * @package BUGTB\Blocks\Button
 */
class Button {

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
		$button_cb = new ButtonCb();

		// Block json file
		$json_file = BUGTB_PLUGIN_FILE_PATH . 'build/button';

		register_block_type_from_metadata(
			$json_file,
			[ 'render_callback' => [ $button_cb, 'render_output' ] ]
		);
	}
}
