<?php

namespace Drupal\test_config_entity;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of foo entities.
 */
class FooEntityListBuilder extends ConfigEntityListBuilder {
  public function buildHeader() {
    $header['label'] = $this->t('Foo');
    $header['id'] = $this->t('Machine name');
    $header['urlPattern'] = $this->t('URL pattern');
    $header['color'] = $this->t('Color');
    return $header + parent::buildHeader();
  }

  public function buildRow(EntityInterface $entity) {
    $row['label'] = $entity->label();
    $row['id'] = $entity->id();
    $row['urlPattern'] = $entity->getUrlPattern();
    $row['color'] = $entity->getColor();
    return $row + parent::buildRow($entity);
  }
}
