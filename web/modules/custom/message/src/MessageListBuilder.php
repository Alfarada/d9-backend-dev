<?php

namespace Drupal\message;

use Drupal\Core\Datetime\DateFormatterInterface;
use Drupal\Core\Link;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\{EntityInterface, EntityListBuilder, EntityStorageInterface, EntityTypeInterface};

class MessageListBuilder extends EntityListBuilder {

  public function __construct(
    EntityTypeInterface $entity_type,
    EntityStorageInterface $storage,
    protected DateFormatterInterface $date_formatter) {

    parent::__construct($entity_type, $storage);
  }
  /**
   * {@inheritdoc}
   */
  public static function createInstance(ContainerInterface $container, EntityTypeInterface $entity_type) {
    return new static(
      $entity_type,
      $container->get('entity_type.manager')->getStorage($entity_type->id()),
      $container->get('date.formatter')
    );
  }
  /**
   * {@inheritdoc}
   */
  public function buildHeader(){
    $header['id'] = $this->t('Message ID');
    $header['from'] = $this->t('From');
    $header['to'] = $this->t('To');
    $header['subject'] = $this->t('Subject');
    $header['created'] = $this->t('Created');

    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['id'] = $entity->toLink($entity->id());
    $row['from'] = $entity->getOwner()->getAccounName();
    $row['to'] = $entity->getUserTo()->getAccounName();
    $row['subject'] = Link::createFromRoute(
      $entity->label(),
      'entity.entities_message.edit_form',
      ['entities_message' => $entity->id()]
    );
    $row['created'] = $this->date_formatter->format($entity->getCreatedTime(), 'short');
    return $row + parent::buildRow($entity);

  }
}