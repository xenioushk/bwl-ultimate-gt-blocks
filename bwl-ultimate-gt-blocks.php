<?php

/**
 * Plugin Name:     BWL Ultimate Gutenberg Blocks
 * Description:       BWL Ultimate Gutenberg Blocks
 * Requires at least: 6.0
 * Requires PHP:      8.0
 * Version:             0.0.1
 * Author:            Mahbub Alam Khan
 * License:           GPL-2.0-or-later
 * License URI:      https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:     bwl-ultimate-gt-blocks
 *
 * @package           BwlUltimateGtBlocks
 */


namespace BwlUltimateGtBlocks;

// security check.
defined('ABSPATH') or die('Unauthorized access');

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
	require_once __DIR__ . '/vendor/autoload.php';
}

define('BWL_ULTIMATE_GT_BLOCKS_DIR', __DIR__);

use BwlUltimateGtBlocks\Base\Activate;
use BwlUltimateGtBlocks\Base\Deactivate;

function active_bwl_ultimate_gt_blocks()
{
	Activate::activate();
}

\register_activation_hook(__FILE__, __NAMESPACE__ . '\\active_bwl_ultimate_gt_blocks');

function deactive_bwl_ultimate_gt_blocks()
{
	Deactivate::deactivate();
}

\register_activation_hook(__FILE__, __NAMESPACE__ . '\\deactive_bwl_ultimate_gt_blocks');

if (class_exists('\BwlUltimateGtBlocks\\Init')) {

	\BwlUltimateGtBlocks\Init::register_services();
}
