<?php

/**
 * @package BwlUltimateGtBlocks
 */

namespace BwlUltimateGtBlocks\Base;

class Activate extends BaseController
{

	public static function activate()
	{

		flush_rewrite_rules();
	}
}
