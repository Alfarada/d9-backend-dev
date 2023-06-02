<?php

namespace Drupal\ja_most_simple\Entity;

use Drupal\Core\Entity\ContentEntityBase;

/**
 * Defines the Ja Most Simple entity.
 *
 * @ContentEntityType(
 *   id = "ja_most_simple",
 *   label = @Translation("Ja Most Simple"),
 *   base_table = "ja_most_simple",
 *   entity_keys = {
 *     "id" = "id",
 *     "bundle" = "bundle",
 *   },
 *   fieldable = TRUE,
 *   admin_permission = "administer ja_most_simple types",
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
 *     "canonical" = "/ja_most_simple/{ja_most_simple}",
 *     "add-page" = "/ja_most_simple/add",
 *     "add-form" = "/ja_most_simple/add/{ja_most_simple_type}",
 *     "edit-form" = "/ja_most_simple/{ja_most_simple}/edit",
 *     "delete-form" = "/ja_most_simple/{ja_most_simple}/delete",
 *     "collection" = "/admin/content/ja_most_simples",
 *   },
 *   bundle_entity_type = "ja_most_simple_type",
 *   field_ui_base_route = "entity.ja_most_simple_type.edit_form",
 * )
 */
class MostSimpleEntity extends  ContentEntityBase {}
