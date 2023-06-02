<?php

namespace Drupal\ja_most_simple\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Ja Most Simple Type entity. A configuration entity used to manage
 * bundles for the Ja Most Simple entity.
 *
 * @ConfigEntityType(
 *   id = "ja_most_simple_type",
 *   label = @Translation("Ja Most Simple Type"),
 *   bundle_of = "ja_most_simple",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   config_prefix = "ja_most_simple_type",
 *   config_export = {
 *     "id",
 *     "label",
 *   },
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\Core\Entity\EntityListBuilder",
 *     "form" = {
 *       "default" = "Drupal\ja_most_simple\Form\MostSimpleTypeEntityForm",
 *       "add" = "Drupal\ja_most_simple\Form\MostSimpleTypeEntityForm",
 *       "edit" = "Drupal\ja_most_simple\Form\MostSimpleTypeEntityForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer ja_most_simple types",
 *   links = {
 *     "canonical" = "/admin/structure/ja_most_simple_type/{ja_most_simple_type}",
 *     "add-form" = "/admin/structure/ja_most_simple_type/add",
 *     "edit-form" = "/admin/structure/ja_most_simple_type/{ja_most_simple_type}/edit",
 *     "delete-form" = "/admin/structure/ja_most_simple_type/{ja_most_simple_type}/delete",
 *     "collection" = "/admin/structure/ja_most_simple_type",
 *   }
 * )
 */
class MostSimpleTypeEntity extends ConfigEntityBundleBase {};
