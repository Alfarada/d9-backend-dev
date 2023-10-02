<?php

namespace Drupal\plugin_type_example;

use Drupal\Component\Plugin\PluginBase;

abstract class FipsumBase extends PluginBase implements FipsumInterface {

  public function description() {
    return $this->pluginDefinition['description'];
  }

  abstract public function generate($length);

}