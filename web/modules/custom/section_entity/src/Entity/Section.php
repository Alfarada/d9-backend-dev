<?php

namespace Drupal\section_entity\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Node type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "section_entity",
 *   label = @Translation("Section"),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\section_entity\Form\SectionForm",
 *       "edit" = "Drupal\section_entity\Form\SectionForm",
 *       "delete" = "Drupal\section_entity\Form\SectionDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\section_entity\SectionHtmlRouteProvider",
 *     },
 *     "list_builder" = "Drupal\section_entity\SectionListBuilder",
 *   },
 *   admin_permission = "administer site configuration",
 *   config_prefix = "section_entity",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "edit-form" = "/admin/structure/section_entity/{section_entity}",
 *     "add-form" = "/admin/structure/section_entity/add",
 *     "delete-form" = "/admin/structure/section_entity/{section_entity}/delete",
 *     "collection" = "/admin/structure/section_entity",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "description",
 *     "uuid",
 *     "urlPattern",
 *     "color",
 *   }
 * )
 */
class Section extends ConfigEntityBase implements SectionInterface {

  /**
   * The Section ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Section label.
   *
   * @var string
   */
  protected $label;

  /**
   * URL pattern.
   *
   * @var string
   */
  protected $urlPattern;

  /**
   * Color (HEX format)
   *
   * @var string
   */
  protected $color;

  /**
   * {@inheritdoc}
   */
  public function getUrlPattern() {
    return $this->urlPattern;
  }

  /**
   * {@inheritdoc}
   */
  public function getColor() {
    return $this->color;
  }

  /**
   * {@inheritdoc}
   */
  public function setUrlPattern($pattern) {
    $this->urlPattern = $pattern;
    return $this;
  }

  /**
   * {@inheritdoc}*/
  public function setColor($color) {
    $this->color = $color;
    return $this;
  }
}
