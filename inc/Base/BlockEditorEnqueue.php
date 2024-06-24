<?php

/** 
 * @package bwllpgtb
 */

namespace Xenioushk\Bwllpgtb\Base;

class BlockEditorEnqueue extends BaseController
{

  public function register()
  {
    // for admin editor.
    add_action('enqueue_block_editor_assets', [$this, 'enqueueScripts']);
  }

  public function enqueueScripts()
  {
    $assetsInfo = include_once($this->plugin_path . "build/index.asset.php");
    wp_enqueue_style($this->plugin_slug . 'block-editor-style', $this->pluginAssetsDir . 'index.css', [], $assetsInfo['version']);
    wp_enqueue_script($this->plugin_slug . '-block-editor-script', $this->pluginAssetsDir . 'index.js', $assetsInfo['dependencies'], $assetsInfo['version'], TRUE);
  }
}
