<?php

namespace Drupal\message\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\Annotation\ContentEntityType;
use Drupal\user\UserInterface;
use Drupal\Core\Entity\{EntityChangedTrait, EntityStorageInterface};

/**
 * Defines the Message entity.
 *
 * @ContentEntityType(
 *   id = "message",
 *   label = @Translation("Message"),
 *   base_table = "message",
 *   entity_keys = {
 *     "id" = "id",
 *     "bundle" = "type",
 *     "label" = "subject",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   fieldable = TRUE,
 *   admin_permission = "administer simple types",
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\message\MessageListBuilder",
 *     "access" = "Drupal\Core\Entity\EntityAccessControlHandler",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "form" = {
 *       "default" = "Drupal\Core\Entity\ContentEntityForm",
 *       "add" = "Drupal\Core\Entity\ContentEntityForm",
 *       "edit" = "Drupal\Core\Entity\ContentEntityForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   links = {
 *     "canonical" = "/message/{message}",
 *     "add-page" = "/message/add",
 *     "add-form" = "/message/add/{message_type}",
 *     "edit-form" = "/message/{message}/edit",
 *     "delete-form" = "/message/{message}/delete",
 *     "collection" = "/admin/content/message",
 *   },
 *   bundle_entity_type = "message_type",
 *   field_ui_base_route = "entity.message_type.edit_form",
 * )
 */
class MessageEntity extends ContentEntityBase {
  use EntityChangedTrait;
  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += [
      'user_id' => \Drupal::currentUser()->id(),
    ];
  }
  public function getType() {
    return $this->bundle();
  }
  public function getSubject() {
    return $this->get('subject')->value;
  }
  public function setSubject($subject) {
    $this->set('subject', $subject);
    return $this;
  }
  public function getCreatedTime() {
    return $this->get('created')->value;
  }
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }
  public function getOwner() {
    return $this->get('user_id')->entity;
  }
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }
  public function isPublished() {
    return (bool) $this->getEntityKey('status');
  }
  public function setPublished($published) {
    $this->set('status', $published ? TRUE : FALSE);
    return $this;
  }

  public function getUserToId() {
    return $this->get('user_to')->target_id;
  }
  public function setUserToId($uid) {
    $this->set('user_to', $uid);
    return $this;
  }
  public function getUserTo() {
    return $this->get('user_to')->entity;
  }
  public function setUserTo(UserInterface $account) {
    $this->set('user_to', $account->id());
    return $this;
  }
  public function getContent() {
    return $this->get('content')->value;
  }
  public function setContent($content) {
    $this->set('content', $content);
    return $this;
  }
  public function isRead() {
    return (bool) $this->getEntityKey('is_read');
  }
  public function setRead($read) {
    $this->set('is_read', $read ? TRUE : FALSE);
    return $this;
  }


}