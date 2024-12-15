<?php

namespace Xenioushk\BwlLpgtb\Blocks;

use Xenioushk\BwlLpgtb\Base\BaseController;


class Button extends BaseController
{

	public function register(): void
	{
		add_action('init', [$this, 'registerBlock']);
	}


	public function registerBlock(): void
	{

		register_block_type_from_metadata(
			BLPGTB_DIR . '/build/button',
			[
				'render_callback' => function () {
					return "working button";
				},
			]
		);
	}
}
