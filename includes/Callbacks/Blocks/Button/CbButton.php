<?php

namespace BwlUltimateGtBlocks\Callbacks\Blocks\Button;

use BwlUltimateGtBlocks\Base\BaseController;

class CbButton extends BaseController
{

	// public $numberOfPosts        = 5;

	public function __construct() {}

	function render_output(array $attributes = [], $content = ''): string
	{
		// echo "<pre>";
		// print_r($attributes);
		// echo "</pre>";

		// echo "<pre>";
		// print_r(($attributes));
		// echo "</pre>";

		return "<a href='#' class='bwl-ultimate-gt-button {$attributes['size']}'>{$attributes['text']}</a>";
	}
}