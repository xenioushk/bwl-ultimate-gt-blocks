<?php

namespace BwlUltimateGtBlocks\Callbacks\Blocks\LatestPosts;

use BwlUltimateGtBlocks\Base\BaseController;

class CbLatestPosts extends BaseController
{

	public $numberOfPosts        = 5;
	public $order                = 'DESC';
	public $orderBy              = 'date';
	public $categories           = [];
	public $postType             = 'post';
	public $postStatus           = 'publish';
	public $displayFeaturedImage = true;
	public $displayExcerpt       = false;

	public function __construct() {}

	public function get_posts(array $attributes = []): string
	{
		// echo "<pre>";
		// print_r($attributes);
		// echo "</pre>";
		$numberOfPosts              = $attributes['numberOfPosts'] ?? $this->numberOfPosts;
		$order                      = $attributes['order'] ?? $this->order;
		$orderBy                    = $attributes['orderBy'] ?? $this->orderBy;
		$catgories                  = $attributes['categories'] ?? $this->categories;
		$this->displayExcerpt       = $attributes['displayExcerpt'] ?? false ?: false;
		$this->displayFeaturedImage = $attributes['displayFeaturedImage'] ?? false ?: false;

		$args = [
			'post_status'         => $this->postStatus,
			'post_type'           => $this->postType,
			'orderby'             => $orderBy,
			'order'               => $order,
			'posts_per_page'      => $numberOfPosts,
			'ignore_sticky_posts' => 1,
		];

		if (sizeof($catgories) > 0) {
			$args['category__in'] = array_column($catgories, 'id');
		}

		$loop = new \WP_Query($args);

		$output = "<div class='latest-post-block'>";

		if ($loop->have_posts()) :

			while ($loop->have_posts()) :
				$loop->the_post();
				$post_id    = get_the_ID();
				$title      = get_the_title() ?: 'No Title';
				$excerpt    = get_the_excerpt();
				$permalink  = esc_url(get_the_permalink());
				$thumbnail = '';
				$date       = get_the_date();

				$output .= "<div class='post-content'>";

				if ($this->displayFeaturedImage && has_post_thumbnail()) {
					$thumbnail = '<figure>' . get_the_post_thumbnail($post_id, 'large') . '</figure>';
				}

				if (!empty($title)) {
					$output .= "<h2><a href='{$permalink}' title='{$title}'>{$title}</a></h2>";
				}


				if ($this->displayExcerpt && !empty($excerpt)) {
					$output .= "<p>{$excerpt}</p>";
				}

				if (!empty($thumbnail)) {
					$output .= "<div class='featured-image'>{$thumbnail}</div>";
				}

				if (!empty($date)) {
					$output .= "<date>{$date}</date>";
				}

				$output .= "</div>";
			endwhile;

		else :
			$output .= esc_html__('No post found!', 'bwl-ultimate-gt-blocks');
		endif;

		$output = "{$output}</div>";

		return $output;
	}
}