<?php

namespace Drupal\ja_simple\Entity;

use Drupal\Core\Entity\ContentEntityBase;

/**
 * Defines the Simple entity.
 *
 * @ContentEntityType(
 *   id = "ja_simple",
 *   label = @Translation("Simple"),
 *   base_table = "ja_simple",
 *   entity_keys = {
 *     "id" = "id",
 *     "bundle" = "bundle",
 *   },
 *   fieldable = TRUE,
 *   admin_permission = "administer simple types",
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\ja_simple\SimpleListBuilder",
 *     "access" = "Drupal\Core\Entity\EntityAccessControlHandler",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "form" = {
 *       "default" = "Drupal\ja_simple\Form\SimpleEntityForm",
 *       "add" = "Drupal\ja_simple\Form\SimpleEntityForm",
 *       "edit" = "Drupal\ja_simple\Form\SimpleEntityForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   links = {
 *     "canonical" = "/ja-simple/{ja-simple}",
 *     "add-page" = "/ja-simple/add",
 *     "add-form" = "/ja-simple/add/{ja-simple_type}",
 *     "edit-form" = "/ja-simple/{ja-simple}/edit",
 *     "delete-form" = "/ja-simple/{ja-simple}/delete",
 *     "collection" = "/admin/content/ja-simples",
 *   },
 *   bundle_entity_type = "ja_simple_type",
 *   field_ui_base_route = "entity.ja_simple_type.edit_form",
 * )
 */
class SimpleEntity extends ContentEntityBase {

}
