<?php

namespace Drupal\simple\Entity;

use Drupal\Core\Entity\ContentEntityBase;

/**
 * Defines the Simple content entity.
 *
 * @ContentEntityType(
 *   id = "simple",
 *   label = @Translation("Simple Content Entity"),
 *   base_table = "simple",
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
 *     "canonical" = "/simple/{simple}",
 *     "add-page" = "/simple/add",
 *     "add-form" = "/simple/add/{simple_type}",
 *     "edit-form" = "/simple/{simple}/edit",
 *     "delete-form" = "/simple/{simple}/delete",
 *     "collection" = "/admin/content/simples",
 *   },
 *   bundle_entity_type = "simple_type",
 *   field_ui_base_route = "entity.simple_type.edit_form",
 * )
 */

class SimpleEntity extends ContentEntityBase
{

}
