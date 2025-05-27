<?php
namespace BUGTB\Callbacks\Filters\Admin;

/**
 * Class for registering the category sort callabck.
 *
 * @package BwlFaqManager
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 */
class BlockCategoryCb {

	/**
	 * Set block category.
	 *
	 * @param array $categories Block categories.
	 *
	 * @return array
	 */
	public function set_block_category( $categories ) {
		return array_merge(
			$categories,
			[
				[
					'slug'  => 'bptm-gt-blocks',
					'title' => esc_html__( 'Peitions Manager Blocks', 'bwl-ultimate-gt-blocks' ),
					'icon'  => null, // Optional: no icon support yet
				],
			]
		);
	}
}
