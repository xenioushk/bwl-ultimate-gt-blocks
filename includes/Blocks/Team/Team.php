<?php

namespace BwlUltimateGtBlocks\Blocks\Team;

use BwlUltimateGtBlocks\Base\BaseController;
use BwlUltimateGtBlocks\Callbacks\Blocks\Team\CbTeam;

class Team extends BaseController
{

	public function register(): void
	{
		add_action('init', [$this, 'register_block']);
	}

	public function register_block(): void
	{

		$cb_team = new CbTeam();

		register_block_type_from_metadata(
			BWL_ULTIMATE_GT_BLOCKS_DIR . '/build/team',
			[
				'render_callback' => [$cb_team, 'render_output'],
			]
		);
	}
}
