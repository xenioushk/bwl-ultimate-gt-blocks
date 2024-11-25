<?php

/**
 * @package BwlLpgtb
 */

namespace Xenioushk\BwlLpgtb\Base;

class Deactivate
{

	public static function deactivate()
	{
		flush_rewrite_rules();
	}
}
