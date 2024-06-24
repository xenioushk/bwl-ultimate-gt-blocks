<?php

namespace Xenioushk\Bwllpgtb\Blocks\LatestPosts;

use Xenioushk\Bwllpgtb\Base\BaseController;
use Xenioushk\Bwllpgtb\Callbacks\Blocks\LatestPosts\CbLatestPosts;


class LatestPosts extends BaseController
{

  public function __construct()
  {

    $cbLatestPosts = new CbLatestPosts();
    register_block_type_from_metadata(BLPGTB_DIR . '/build', array(
      "render_callback" => [$cbLatestPosts, 'getPosts']
    ));
  }
}
