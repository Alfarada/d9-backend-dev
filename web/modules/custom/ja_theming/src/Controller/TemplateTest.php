<?php

namespace Drupal\ja_theming\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Ja Theming routes.
 */
class TemplateTest extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    // recuerda que debes nombrar el nombre del archivo de estilos
    // css si no el nombre (id) de la libreria.

    $build['item_dimensions'] = [
      '#theme' => 'theming_dimensions',
//      '#attached' => [
//        'library' => [
//          'ja_theming/ja_theming_styles.css'
//        ]
//      ],
      '#length' => 12,
      '#width' => 8,
      '#height' => 24
    ];

    return $build;
  }

  public function content() {
    $build['content'] = [
      '#markup' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus pulvinar fringilla leo in ultrices.</p>'
    ];

    return $build;
  }

}
