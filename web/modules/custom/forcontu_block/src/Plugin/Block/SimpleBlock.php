<?php

namespace Drupal\forcontu_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a Simple example Block.
 *
 * @Block(
 *   id = "forcontu_blocks_simple_block",
 *   admin_label = @Translation("Forcontu Simple Block"),
 *   category = @Translation("Forcontu Blocks"),
 * )
 */
class SimpleBlock extends BlockBase {

  public function build() {
    return [
      '#markup' => '<span>' . $this->t('Sample block') . '</span>',
    ];
  }

  public function defaultConfiguration() {
    return [
      'label' => 'Custom Title',
      'label_display' => FALSE,
    ];
  }

}
