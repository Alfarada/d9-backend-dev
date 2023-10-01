<?php

namespace Drupal\ja_plugins\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\ja_plugins\FipsumPluginManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PluginsController extends ControllerBase {
  protected $fipsum;

  public function __construct(FipsumPluginManager $fipsum) {
    $this->fipsum = $fipsum;
  }

  public static  function create(ContainerInterface $container) {
    return new  static(
      $container->get('plugin.manager.fipsum')
    );
  }

  public function fipsum() {
    $lorem_ipsum = $this->fipsum->createInstance('lorem_ipsum');

    $build['fipsum_lorem_ipsum_title'] = [
      '#markup' => '<h4>' . $lorem_ipsum->description() . '</h4>'
    ];

    $build['fipsum_lorem_ipsum_text'] = [
      '#markup' => '<p>' . $lorem_ipsum->generate(300) . '</p>'
    ];

    $forcontu_ipsum = $this->fipsum->createInstance('forcontu_ipsum');

    $build['fipsum_forcontu_ipsum_title'] = [
      '#markup' => '<h4>' . $forcontu_ipsum->description() . '</h4>'
    ];

    $build['fipsum_forcontu_ipsum_text'] = [
      '#markup' => '<p>' . $forcontu_ipsum->generate(600) . '</p>'
    ];

    return $build;
  }
}
