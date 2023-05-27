<?php

namespace Drupal\forcontu_users\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Render\RendererInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Returns responses for forcontu_users routes.
 */
class ForcontuUsersController extends ControllerBase {

  protected $renderer;

  public function __construct(RendererInterface $renderer) {
    $this->renderer = $renderer;
  }

  public static function create(ContainerInterface $container) {
    return new static($container->get('renderer'));
  }

  /**
   * Builds the response.
   */
  public function build() {

        $build['content'] = [
          '#type' => 'item',
          '#markup' => $this->t('It works!'),
        ];

        return $build;

  }

  public function getDescription() {
    $build = [];
    $build['warning'] = [
      '#markup' => $this->t('Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        Pellentesque mattis est ac magna porta venenatis sed ut libero.'),
    ];
    return $this->renderer->render($build);
  }

  public function renderChildren() {
    $list = ['Item 1', 'Item 2', 'Item 3'];
    $build = [
      'container' => [
        '#prefix' => '<div id="container">',
        '#suffix' => '</div>',
        '#markup' => $this->t('This is a container div'),
        'list' => [
          '#theme' => 'item_list',
          '#title' => $this->t('List of items'),
          '#list_type' => 'ol',
          '#items' => $list,
        ],
      ],
    ];
    return $build;
  }
}
