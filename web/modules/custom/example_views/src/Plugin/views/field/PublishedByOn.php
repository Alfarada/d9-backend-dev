<?php

namespace Drupal\example_views\Plugin\views\field;

use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;

/**
 * Provides BooleanIcon field handler
 *
 * @ViewsField("published_by_on")
 */
class PublishedByOn extends FieldPluginBase {

public function render(ResultRow $values): array {
 $node = $values->_entity;
 $author = $node->getOwner()->getDisplayName();
 $created_time = \Drupal::service('date.formatter')->format($node->getCreatedTime(), 'short');
 return [
   '#markup' => $this->t("Published by @user on @date",
     ['@user' => $author, '@date' => $created_time, ])
 ];
}

  public function query() {
  // This function exists to override parent query function.
  // Do nothing.
  }

}