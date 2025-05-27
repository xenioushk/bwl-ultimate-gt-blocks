<?php

namespace BUGTB\Callbacks\Blocks\Team;

class CbTeam {


	// public $numberOfPosts        = 5;
	// public $order                = 'DESC';
	// public $orderBy              = 'date';
	// public $categories           = [];
	// public $postType             = 'post';
	// public $postStatus           = 'publish';
	// public $displayFeaturedImage = true;
	// public $displayExcerpt       = false;

	public function render_output( array $attributes = [], $content = '' ) {

		return $content;
		// echo "<pre>";
		// print_r($attributes);
		// print_r($content);
		// echo "</pre>";

		// $output = "";

		// return $output;
	}

	public function render_child_output( array $attributes = [] ) {

		return 'hello';
		// echo "<pre>";
		// print_r($attributes);
		// echo "</pre>";

		if ( ! empty( $attributes['title'] ) ) {
			$output = '<h2>' . $attributes['title'] . '</h2>';
		} else {
			$output = '';
		}

		$output = 'child content';

		return $output;
	}
}
