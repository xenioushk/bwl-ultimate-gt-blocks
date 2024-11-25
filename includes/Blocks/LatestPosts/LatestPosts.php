<?php

namespace Xenioushk\BwlLpgtb\Blocks\LatestPosts;

use Xenioushk\BwlLpgtb\Base\BaseController;
use Xenioushk\BwlLpgtb\Callbacks\Blocks\LatestPosts\CbLatestPosts;


class LatestPosts extends BaseController
{

	public function register(): void
	{
		add_action('init', [$this, 'registerBlock']);
	}


	public function registerBlock(): void
	{
		$cbLatestPosts = new CbLatestPosts();
		register_block_type_from_metadata(
			BLPGTB_DIR . '/build',
			[
				'render_callback' => [$cbLatestPosts, 'getPosts'],
			]
		);
	}
}
