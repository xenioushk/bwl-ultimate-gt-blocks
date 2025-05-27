<?php

namespace BUGTB\Blocks\Heading;

use BUGTB\Callbacks\Blocks\Heading\HeadingCb;

/**
 * Class Heading Block
 *
 * @package BUGTB
 */
class Heading {

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
		$heading_cb = new HeadingCb();

		// Block json file
		$json_file = BUGTB_PLUGIN_FILE_PATH . 'build/heading';

		register_block_type_from_metadata(
			$json_file,
			[ 'render_callback' => [ $heading_cb, 'render_output' ] ]
		);
	}
}
