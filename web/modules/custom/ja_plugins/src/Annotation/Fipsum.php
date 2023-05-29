<?php

namespace Drupal\ja_plugins\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Fipsum annotation object
 *
 * @see \Drupal\ja_plugins\FipsumPluginManager
 * @see plugin_api
 *
 * @Annotation
 */

class Fipsum extends Plugin {

  /*
   * The plugin ID
   */
  public string $id;

  /*
   * The description plugin
   */

  public string $description;
}
