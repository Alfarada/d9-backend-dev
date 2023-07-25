<?php

namespace Drupal\medium\Entity;

use Drupal\Core\Entity\ContentEntityBase;

/**
 * Defines the Medium content entity.
 *
 * @ContentEntityType(
 *   id = "medium",
 *   label = @Translation("Medium Content Entity"),
 *   base_table = "medium",
 *   entity_keys = {
 *     "id" = "id",
 *     "bundle" = "bundle",
 *   },
 *   fieldable = TRUE,
 *   admin_permission = "administer medium types",
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\medium\MediumListBuilder",
 *     "access" = "Drupal\Core\Entity\EntityAccessControlHandler",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "form" = {
 *       "default" = "Drupal\simple\Form\MediumEntityForm",
 *       "add" = "Drupal\medium\Form\MediumEntityForm",
 *       "edit" = "Drupal\medium\Form\MediumEntityForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   links = {
 *     "canonical" = "/medium/{medium}",
 *     "add-page" = "/medium/add",
 *     "add-form" = "/medium/add/{medium_type}",
 *     "edit-form" = "/medium/{medium}/edit",
 *     "delete-form" = "/medium/{medium}/delete",
 *     "collection" = "/admin/content/mediums",
 *   },
 *   bundle_entity_type = "medium_type",
 *   field_ui_base_route = "entity.medium_type.edit_form",
 * )
 */

class MediumEntity extends ContentEntityBase
{

}
