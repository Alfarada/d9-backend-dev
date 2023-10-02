<?php

/**
 * @file
 * Contains \Drupal\plugin_type_example\Controller\PluginTypeController.
 */

namespace Drupal\plugin_type_example\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\plugin_type_example\FipsumPluginManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PluginTypeController extends ControllerBase {
  protected $fipsum;
  public function __construct(FipsumPluginManager $fipsum) {
    $this->fipsum = $fipsum;
  }
  public static function create(ContainerInterface $container): self {
    return new static(
      $container->get('plugin.manager.fipsum')
    );
  }
  public function fipsum() {
    $lorem_ipsum = $this->fipsum->createInstance('lorem_ipsum');
    $build['fipsum_lorem_ipsum_title'] = [
      '#markup' => '<h2>' . $lorem_ipsum->description() . '</h2>',
    ];
    $build['fipsum_lorem_ipsum_text'] = [
      '#markup' => '<p>' . $lorem_ipsum->generate(300) . '</p>',
    ];
    $forcontu_ipsum = $this->fipsum->createInstance('forcontu_ipsum');
    $build['fipsum_forcontu_ipsum_title'] = [
      '#markup' => '<h2>' . $forcontu_ipsum->description() . '</h2>',
    ];
    $build['fipsum_forcontu_ipsum_text'] = [
      '#markup' => '<p>' . $forcontu_ipsum->generate(600) . '</p>',
    ];
    return $build;
  }

}