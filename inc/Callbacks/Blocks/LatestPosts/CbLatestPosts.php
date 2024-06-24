<?php

namespace Xenioushk\Bwllpgtb\Callbacks\Blocks\LatestPosts;

use Xenioushk\Bwllpgtb\Base\BaseController;

class CbLatestPosts extends BaseController
{

  public $numberOfPosts = 5;
  public $order = "DESC";
  public $orderBy = "date";
  public $categories = [];
  public $postType = "post";
  public $postStatus = "publish";

  public function __construct()
  {
  }


  function getPosts($atts = [])
  {

    // echo "<pre>";
    // print_r($atts);
    // echo "</pre>";
    $numberOfPosts = $atts['numberOfPosts'] ?? $this->numberOfPosts;
    $showImage = (isset($atts['displayFeaturedImage']) &&  $atts['displayFeaturedImage'] == true) ? true : false;
    $order = $atts['order'] ?? $this->order;
    $orderBy = $atts['orderBy'] ?? $this->orderBy;
    $catgories = $atts['categories'] ?? $this->categories;


    $args = array(
      'post_status' => $this->postStatus,
      'post_type' => $this->postType,
      'orderby' => $orderBy,
      'order' => $order,
      'posts_per_page' => $numberOfPosts,
      'ignore_sticky_posts' => 1
    );

    if (sizeof($catgories) > 0) {
      $args['category__in'] = array_column($catgories, 'id');
    }

    // echo "<pre>";
    // print_r($args);
    // echo "</pre>";


    $loop = new \WP_Query($args);


    if ($loop->have_posts()) :

      ob_start();
      echo '<div class="lastst-post-block">';
      while ($loop->have_posts()) :

        $loop->the_post();
        $post_id = get_the_ID();
        $title = get_the_title() ?: "No Title";
        $permalink = esc_url(get_the_permalink());
        $news_thumb = "";

        if ($showImage == true && has_post_thumbnail()) {
          $news_thumb = "<figure>" . get_the_post_thumbnail($post_id, 'large') . "</figure>";
        }

?>
        <h2><a href=<?php echo $permalink ?> title=<?php echo $title ?>><?php echo $title ?></a></h2>
        <div class="featured-image"><?php echo $news_thumb ?></div>


<?php
      endwhile;
      echo "</div>";
      return ob_get_clean();

    else :
      return esc_html("No Post Found", $this->plugin_text_domain);
    endif;
  }
}
