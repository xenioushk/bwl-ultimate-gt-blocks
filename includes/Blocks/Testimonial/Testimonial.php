<?php

namespace BwlUltimateGtBlocks\Blocks\Testimonial;

use BwlUltimateGtBlocks\Base\BaseController;

class Testimonial {

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

		register_block_type_from_metadata(
			BWL_ULTIMATE_GT_BLOCKS_DIR . '/build/testimonial',
			[
				'render_callback' => function () {
					return 'working button';
				},
			]
		);
	}
}
