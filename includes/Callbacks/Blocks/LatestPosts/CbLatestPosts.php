<?php

namespace Xenioushk\BwlLpgtb\Callbacks\Blocks\LatestPosts;

use Xenioushk\BwlLpgtb\Base\BaseController;

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

	function getPosts(array $attributes = [])
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

		// echo "<pre>";
		// print_r($args);
		// echo "</pre>";

		$loop = new \WP_Query($args);

		if ($loop->have_posts()) :

			ob_start();
			echo '<div class="latest-post-block">';

			while ($loop->have_posts()) :
				echo '<div class="post-content">';
				$loop->the_post();
				$post_id    = get_the_ID();
				$title      = get_the_title() ?: 'No Title';
				$excerpt    = get_the_excerpt();
				$permalink  = esc_url(get_the_permalink());
				$news_thumb = '';
				$date       = get_the_date();

				if ($this->displayFeaturedImage && has_post_thumbnail()) {
					$news_thumb = '<figure>' . get_the_post_thumbnail($post_id, 'large') . '</figure>';
				}

?>
				<h2><a href=<?php echo $permalink; ?> title=<?php echo $title; ?>><?php echo $title; ?></a></h2>

				<?php echo $this->displayExcerpt ? "<p>{$excerpt}</p>" : ''; ?>

				<div class="featured-image"><?php echo $news_thumb; ?></div>
				<date><?php echo $date; ?></date>


<?php
				echo '</div>';
			endwhile;
			echo '</div>';
			return ob_get_clean();

		else :
			return esc_html('No post found!', $this->plugin_text_domain);
		endif;
	}
}
