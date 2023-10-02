<?php

namespace Drupal\plugin_type_example;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\plugin_type_example\Annotation\Fipsum;

/**
 * Provides the plugin manager for Fipsum plugins.
 */
class FipsumPluginManager extends DefaultPluginManager {
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    $subdir = 'Plugin/Fipsum';
    $plugin_interface = FipsumInterface::class;
    $plugin_definition_annotation_name = Fipsum::class;

    parent::__construct($subdir, $namespaces, $module_handler, $plugin_interface, $plugin_definition_annotation_name);

    $this->alterInfo('plugin_type_example_fipsum_info');
    $this->setCacheBackend($cache_backend, 'plugin_type_example_fipsum_info');
  }
}