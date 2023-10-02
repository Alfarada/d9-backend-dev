<?php

namespace Drupal\plugin_type_example\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Fipsum annotation object.
 *
 * @see \Drupal\plugin_type_example\FipsumPluginManager
 * @see plugin_api
 *
 * @Annotation
 */
class Fipsum extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The description of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $description;

}