<?php

namespace Drupal\message\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Most Simple Type entity. A configuration entity used to manage
 * bundles for the Most Simple entity.
 *
 * @ConfigEntityType(
 *   id = "message_type",
 *   label = @Translation("Message Type"),
 *   bundle_of = "message",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   config_prefix = "message_type",
 *   config_export = {
 *     "id",
 *     "label",
 *   },
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\Core\Entity\EntityListBuilder",
 *     "form" = {
 *       "default" = "Drupal\message\Form\MessageTypeEntityForm",
 *       "add" = "Drupal\message\Form\MessageTypeEntityForm",
 *       "edit" = "Drupal\message\Form\MessageTypeEntityForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer message types",
 *   links = {
 *     "canonical" = "/admin/structure/message_type/{message_type}",
 *     "add-form" = "/admin/structure/message_type/add",
 *     "edit-form" = "/admin/structure/message_type/{message_type}/edit",
 *     "delete-form" = "/admin/structure/message_type/{message_type}/delete",
 *     "collection" = "/admin/structure/message_type",
 *   }
 * )
 */
class MessageTypeEntity extends ConfigEntityBundleBase { }