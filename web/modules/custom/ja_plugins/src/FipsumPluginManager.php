<?php

namespace Drupal\ja_plugins;

use Drupal\ja_plugins\Annotation\Fipsum;
use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Cache\CacheBackendInterface;

/**
 * Prodives the plugin manager for Fipsum plugins.
 */
class FipsumPluginManager extends DefaultPluginManager {
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {

    $subdir = 'Plugin/Fipsum';
    $plugin_interface = FipsumInterface::class;
    $plugin_definition_annotation_name = Fipsum::class;

    parent::__construct($subdir, $namespaces, $module_handler, $plugin_interface, $plugin_definition_annotation_name);

    $this->alterInfo('ja_plugins_fipsum_info');
    $this->setCacheBackend($cache_backend, 'ja_plugins_fipsum_info');
  }
}
