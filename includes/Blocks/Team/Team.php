<?php

namespace BUGTB\Blocks\Team;

use BUGTB\Callbacks\Blocks\Team\CbTeam;

/**
 * Class Team Block
 *
 * @package BUGTB
 */
class Team {

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

		$cb_team = new CbTeam();

		// Block json file
		$team_json_file        = BUGTB_PLUGIN_FILE_PATH . 'build/team';
		$team_member_json_file = BUGTB_PLUGIN_FILE_PATH . 'build/team-member';

		register_block_type_from_metadata(
			$team_json_file,
			[
				'render_callback' => [ $cb_team, 'render_output' ],
			]
		);

		register_block_type_from_metadata(
			$team_member_json_file,
			[
				'render_callback' => [ $cb_team, 'render_child_output' ],
			]
		);
	}
}
