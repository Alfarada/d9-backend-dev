<?php

namespace Drupal\message;

use Drupal\Core\Link;
use Drupal\Core\Datetime\DateFormatterInterface;
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
  public static function createInstance(ContainerInterface $container, EntityTypeInterface $entity_type): self {
    return new static(
      $entity_type,
      $container->get('entity_type.manager')->getStorage($entity_type->id()),
      $container->get('date.formatter')
    );
  }
  /**
   * {@inheritdoc}
   */
  public function buildHeader(): array {
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
  public function buildRow(EntityInterface $entity): array {
     /** @var \Drupal\message\Entity\MessageEntityInterface $entity */
    $row['id'] = $entity->id();
    $row['from'] = $entity->getOwner()->getAccountName();
    $row['to'] = $entity->getUserTo()->getAccountName();
    $row['subject'] = Link::createFromRoute(
      $entity->label(),
      'entity.message.edit_form',
      ['message' => $entity->id()]
    );

    $row['created'] = $this->date_formatter->format($entity->getCreatedTime(), 'short');
    return $row + parent::buildRow($entity);

  }
}