<?php

namespace Drupal\plugin_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a Block Simple
 *
 * @Block(
 *   id="block_plugin_simple",
 *   admin_label=@Translation("Block Plugin Simple T")
 * )
 */
class BlockSimple extends BlockBase {

  public function build(): array {
    return ['#markup' => $this->t('This is a simple block')];
  }

}