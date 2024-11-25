<?php

/**
 * Plugin Name:     BWL Latest Posts Gutenberg Block
 * Description:       A Gutenberg block that has been designed to display the most recent WordPress posts. Arrange posts by date and title, and filter them according to the categories. It also displays or hides the post's featured image.
 * Requires at least: 6.0
 * Requires PHP:      7.0
 * Version:             1.0.0
 * Author:            Mahbub Alam Khan
 * License:           GPL-2.0-or-later
 * License URI:      https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:     bwllpgtb
 *
 * @package           BwlLpgtb
 */

namespace BwlLpgtb;

// security check.
defined('ABSPATH') or die('Unauthorized access');

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
	require_once __DIR__ . '/vendor/autoload.php';
}

define('BLPGTB_DIR', __DIR__);

use Xenioushk\BwlLpgtb\Base\Activate;
use Xenioushk\BwlLpgtb\Base\Deactivate;

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

	\Xenioushk\BwlLpgtb\Init::registerServices();
}
