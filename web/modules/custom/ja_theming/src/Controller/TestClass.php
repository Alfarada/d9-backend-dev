<?php

namespace Drupal\ja_theming\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Render\RendererInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
class TestClass extends ControllerBase {
  protected $renderer;
  public function __construct(RendererInterface $renderer) {
    $this->renderer = $renderer;
  }
  public static function create(ContainerInterface $container) {

    $renderer  = $container->get('renderer');
    return new static($renderer);
  }
  public function getDescription() {

    // NOT WORKING

    $build = [];
    $build['warning'] = [
      '#markup' => $this->t('Lorem ipsum dolor sit amet, consectetur adipiscing elit.
Pellentesque mattis est ac magna porta venenatis sed ut libero.'),
    ];
    $output = $this->renderer->render($build);

    return $output;
  }
}
