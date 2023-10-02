<?php

namespace Drupal\plugin_type_example;
/**
 * Interface for all Fipsum type plugins.
 */
interface FipsumInterface {
  public function description();
  public function generate($length);
}