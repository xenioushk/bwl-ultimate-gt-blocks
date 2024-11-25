<?php

/**
 * @package bwllpgtb
 */

namespace Xenioushk\Bwllpgtb\Base;

class Deactivate {

	public static function deactivate() {
		flush_rewrite_rules();
	}
}
