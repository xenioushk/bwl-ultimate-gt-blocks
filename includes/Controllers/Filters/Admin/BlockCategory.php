<?php
namespace BUGTB\Controllers\Filters\Admin;

use Xenioushk\BwlPluginApi\Api\Filters\FiltersApi;
use BUGTB\Callbacks\Filters\Admin\BlockCategoryCb;

/**
 * Class for registering the block category.
 *
 * @since: 1.0.0
 * @package BUGTB
 */
class BlockCategory {

    /**
	 * Register filters.
	 */
    public function register() {

        // Initialize API.
        $filters_api = new FiltersApi();

        // Filters.
        $filters = [
            [
				'tag'      => 'block_categories_all',
				'callback' => [ ( new BlockCategoryCb() ), 'set_block_category' ],
            ],
        ];

        $filters_api->add_filters( $filters )->register();
    }
}
