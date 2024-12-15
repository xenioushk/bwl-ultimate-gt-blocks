<?php

/**
 * @package BwlUltimateGtBlocks
 */

namespace BwlUltimateGtBlocks\Base;

class Deactivate
{

	public static function deactivate()
	{
		flush_rewrite_rules();
	}
}
