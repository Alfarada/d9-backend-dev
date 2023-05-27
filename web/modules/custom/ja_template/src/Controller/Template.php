<?php

namespace Drupal\ja_template\Controller;

use Drupal\Core\Controller\ControllerBase;

class Template extends ControllerBase {

  public function render() {

    // Este es un claro ejemplo de como y cuando debémos usar
    // las plantillas en drupal.

    $build['item_dimensions'] = [
      '#theme' => 'ja_template_dimensions',
      '#length' => 12,
      '#width' => 8,
      '#height' => 24,
    ];

    $data = [12, 8, 24];

    $build['item_test'] = [
      '#prefix' => '<p class="item-test-dimensions">',
      '#suffix' => '</p>',
      '#markup' => 'Dimensions (length x width x height): ' . $data[0] . ' x ' . $data[1] . ' x ' . $data[2] . ' cm.',
    ];

    return $build;
  }

}
