<?php

namespace BwlUltimateGtBlocks\Blocks\Button;

use BwlUltimateGtBlocks\Base\BaseController;
use BwlUltimateGtBlocks\Callbacks\Blocks\Button\CbButton;

class Button extends BaseController
{

	public function register(): void
	{
		add_action('init', [$this, 'register_block']);
	}

	public function register_block(): void
	{

		$cb_button = new CbButton();

		register_block_type_from_metadata(
			BWL_ULTIMATE_GT_BLOCKS_DIR . '/build/button',
			[
				'render_callback' => [$cb_button, 'render_output']
			]
		);
	}
}