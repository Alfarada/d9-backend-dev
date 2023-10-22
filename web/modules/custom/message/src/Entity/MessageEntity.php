<?php

namespace Drupal\message\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\Annotation\ContentEntityType;
/**
 * Defines the Message entity.
 *
 * @ContentEntityType(
 *   id = "message",
 *   label = @Translation("Message"),
 *   base_table = "message",
 *   entity_keys = {
 *     "id" = "id",
 *     "bundle" = "bundle",
 *   },
 *   fieldable = TRUE,
 *   admin_permission = "administer simple types",
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\Core\Entity\EntityListBuilder",
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
class MessageEntity extends ContentEntityBase { }