<?php

namespace BwlUltimateGtBlocks\Blocks\LatestPosts;

use BwlUltimateGtBlocks\Base\BaseController;
use BwlUltimateGtBlocks\Callbacks\Blocks\LatestPosts\CbLatestPosts;

class LatestPosts extends BaseController {


	public function register(): void {
		add_action( 'init', [ $this, 'register_block' ] );
	}

	public function register_block(): void {
		$cb_latest_posts = new CbLatestPosts();
		register_block_type_from_metadata(
			BWL_ULTIMATE_GT_BLOCKS_DIR . '/build',
			[
				'render_callback' => [ $cb_latest_posts, 'get_posts' ],
			]
		);
	}
}
