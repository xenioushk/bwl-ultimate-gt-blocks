<?php

/**
 * @package bwllpgtb
 */

namespace Xenioushk\Bwllpgtb\Base;

class Activate extends BaseController {

	public static function activate() {

		flush_rewrite_rules();
	}
}
