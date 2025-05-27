<?php
namespace BUGTB\Controllers\Blocks\Petitions;

use BUGTB\Helpers\PluginConstants;
use BUGTB\Callbacks\Blocks\Petitions\PetitionBlocksCb;

/**
 * Class PetitionBlocks
 *
 * @package BUGTB
 */
class PetitionBlocks {

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
		$petition_blocks_cb = new PetitionBlocksCb();

		$petition_blocks = PluginConstants::$gt_blocks;

		foreach ( $petition_blocks as $block ) {

			// Navigate to the src/petition-<block> folder.
			$block_json_path = BUGTB_PLUGIN_FILE_PATH . "build/petition-{$block}/";

			register_block_type_from_metadata(
				$block_json_path,
				[ 'render_callback' => [ $petition_blocks_cb, 'render_output' ] ]
			);
		}

	}
}