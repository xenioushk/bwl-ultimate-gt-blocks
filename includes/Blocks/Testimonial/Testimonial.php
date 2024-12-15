<?php

namespace BwlUltimateGtBlocks\Blocks\Testimonial;

use BwlUltimateGtBlocks\Base\BaseController;

class Testimonial extends BaseController
{

	public function register(): void
	{
		add_action('init', [$this, 'register_block']);
	}

	public function register_block(): void
	{

		register_block_type_from_metadata(
			BWL_ULTIMATE_GT_BLOCKS_DIR . '/build/testimonial',
			[
				'render_callback' => function () {
					return "working button";
				},
			]
		);
	}
}
