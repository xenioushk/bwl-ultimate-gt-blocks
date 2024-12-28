<?php

namespace BwlUltimateGtBlocks\Blocks\Button;

use BwlUltimateGtBlocks\Base\BaseController;

class Button extends BaseController
{

	public function register(): void
	{
		add_action('init', [$this, 'register_block']);
	}

	public function register_block(): void
	{

		register_block_type_from_metadata(
			BWL_ULTIMATE_GT_BLOCKS_DIR . '/build/button',
			[
				'render_callback' => function () {
					return "working button";
				},
			]
		);
	}
}