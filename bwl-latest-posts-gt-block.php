<?php

/**
 * Plugin Name:     BWL Latest Posts Gutenberg Block
 * Description:       A Gutenberg block that has been designed to display the most recent WordPress posts. Arrange posts by date and title, and filter them according to the categories. It also displays or hides the post's featured image.
 * Requires at least: 6.0
 * Requires PHP:      7.0
 * Version:           	1.0.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:      https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:     bwl-lp-gt-block
 *
 * @package           BwlLpGtBlock
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

function cbLatestPosts($atts, $content)
{
	// echo "<pre>";
	// print_r($atts);
	// echo "</pre>";
	$limit = $atts['numberOfPosts'] ?? 5;
	$showImage = (isset($atts['displayFeaturedImage']) &&  $atts['displayFeaturedImage'] == true) ? true : false;
	$order = $atts['order'] ?? "desc";
	$orderby = $atts['orderBy'] ?? "date";
	$catgories = $atts['categories'] ?? [];


	$args = array(
		// 'category_name' => $category,
		// 'post_status' => 'publish',
		'post_type' => 'post',
		'orderby' => $orderby,
		'order' => $order,
		'posts_per_page' => $limit,
		'ignore_sticky_posts' => 1
	);

	if (sizeof($catgories) > 0) {

		$args['category__in'] = array_column($catgories, 'id');
	}

	// echo "<pre>";
	// print_r($args);
	// echo "</pre>";


	$loop = new WP_Query($args);


	if ($loop->have_posts()) :

		ob_start();
		while ($loop->have_posts()) :

			$loop->the_post();
			$post_id = get_the_ID();
			$title = get_the_title() ?: "No Title";
			$permalink = get_the_permalink();
			echo "<h2><a href={$permalink} title={$title}>{$title}</a></h2>";
			if ($showImage == true && has_post_thumbnail()) {

				$news_thumb = get_the_post_thumbnail($post_id, 'large');
				echo "<figure>{$news_thumb}</figure>";
			}

		endwhile;
		return ob_get_clean();

	else :
		return "No Post Found";
	endif;

	// echo "<pre>";
	// print_r($atts);
	// echo "</pre>";
	// return "Hello from PHP";
}

function bwl_latest_posts_bwl_latest_posts_block_init()
{
	// register_block_type(__DIR__ . '/build');
	register_block_type_from_metadata(__DIR__ . '/build', array(
		"render_callback" => "cbLatestPosts"
	));
}
add_action('init', 'bwl_latest_posts_bwl_latest_posts_block_init');