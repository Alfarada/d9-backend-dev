<?php

namespace Drupal\section_entity;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

class SectionListBuilder extends ConfigEntityListBuilder {
  public function buildHeader() {
    $header['label'] = $this->t('Section');
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
