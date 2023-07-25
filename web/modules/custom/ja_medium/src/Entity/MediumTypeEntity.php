<?php

namespace Drupal\medium\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the  Medium Type entity. A configuration entity used to manage
 * bundles for the Medium entity.
 *
 * @ConfigEntityType(
 *   id = "medium_type",
 *   label = @Translation("Medium Type"),
 *   bundle_of = "medium",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   config_prefix = "medium_type",
 *   config_export = {
 *     "id",
 *     "label",
 *   },
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\medium\MediumTypeListBuilder",
 *     "form" = {
 *       "default" = "Drupal\medium\Form\MediumTypeEntityForm",
 *       "add" = "Drupal\medium\Form\MediumTypeEntityForm",
 *       "edit" = "Drupal\medium\Form\MediumTypeEntityForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer medium types",
 *   links = {
 *     "canonical" = "/admin/structure/medium_type/{medium_type}",
 *     "add-form" = "/admin/structure/medium_type/add",
 *     "edit-form" = "/admin/structure/medium_type/{medium_type}/edit",
 *     "delete-form" = "/admin/structure/medium_type/{medium_type}/delete",
 *     "collection" = "/admin/structure/medium_type",
 *   }
 * )
 */
class MediumTypeEntity extends ConfigEntityBundleBase {}