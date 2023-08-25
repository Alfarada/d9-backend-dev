<?php

namespace Drupal\plugin_example\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a exmaple block
 *
 * @Block(
 *   id="plugin_example_block_example",
 *   admin_label=@translation("Plugin Example")
 * )
 */
class BlockExample extends BlockBase {

  public function build(): array {
    return [
      '#markup' => '<span>' . $this->t(' Lorem ipsum dolor sit amet, consectetur adipiscing elit.') . '</span>',
    ];
  }

}