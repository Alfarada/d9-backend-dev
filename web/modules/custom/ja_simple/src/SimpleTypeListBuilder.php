<?php

namespace Drupal\ja_simple;

use Drupal\Core\Entity\{EntityInterface, EntityListBuilder};

/**
 * Class SimpleTypeListBuilder
 */
class SimpleTypeListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader(){
    $header['label'] = $this->t('Label');
    $header['id'] = $this->t('Machine name');

    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['label'] = $entity->label();
    $row['id'] = $entity->id();

    return $row + parent::buildRow($entity);
  }
}
