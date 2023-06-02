<?php

namespace Drupal\ja_simple\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Simple Type entity. A configuration entity used to manage
 * bundles for the Simple entity.
 *
 * @ConfigEntityType(
 *   id = "ja_simple_type",
 *   label = @Translation("Simple Type"),
 *   bundle_of = "ja_simple",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   config_prefix = "ja_simple_type",
 *   config_export = {
 *     "id",
 *     "label",
 *   },
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\ja_simple\SimpleTypeListBuilder",
 *     "form" = {
 *       "default" = "Drupal\ja_simple\Form\SimpleTypeEntityForm",
 *       "add" = "Drupal\ja_simple\Form\SimpleTypeEntityForm",
 *       "edit" = "Drupal\ja_simple\Form\SimpleTypeEntityForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer simple types",
 *   links = {
 *     "canonical" = "/admin/structure/ja-simple-type/{ja-simple-type}",
 *     "add-form" = "/admin/structure/ja-simple-type/add",
 *     "edit-form" = "/admin/structure/ja-simple-type/{ja-simple-type}/edit",
 *     "delete-form" = "/admin/structure/ja-simple-type/{ja-simple-type}/delete",
 *     "collection" = "/admin/structure/ja-simple-type",
 *   }
 * )
 */
class SimpleTypeEntity extends ConfigEntityBundleBase {}
