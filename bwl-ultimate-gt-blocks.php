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

define('BLPGTB_DIR', __DIR__);

use Xenioushk\BwlUltimateGtBlocks\Base\Activate;
use Xenioushk\BwlUltimateGtBlocks\Base\Deactivate;

function bwllpgtbActivePlugin()
{
	Activate::activate();
}

register_activation_hook(__FILE__, 'bwllpgtbActivePlugin');

function bwllpgtbDeactivePlugin()
{
	Deactivate::deactivate();
}

register_activation_hook(__FILE__, 'bwllpgtbDeactivePlugin');

if (class_exists('\Xenioushk\\BwlLpgtb\\Init')) {

	\Xenioushk\BwlUltimateGtBlocks\Init::registerServices();
}
