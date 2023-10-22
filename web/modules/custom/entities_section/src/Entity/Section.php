<?php

namespace Drupal\entities_section\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\Core\Entity\Annotation\ConfigEntityType;

/**
 * Defines the Node type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "entities_section",
 *   label = @Translation("Entities Section Example"),
 *   label_collection = @Translation("Content types"),
 *   handlers = {
 *     "list_builder" = "Drupal\entities_section\SectionListBuilder",
 *     "form" = {
 *       "add" = "Drupal\entities_section\Form\SectionForm",
 *       "edit" = "Drupal\entities_section\Form\SectionForm",
 *       "delete" = "Drupal\entities_section\Form\SectionDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\entities_section\SectionHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "entities_section",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid",
 *     "urlPattern",
 *     "color"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/entities_section/{entities_section}",
 *     "add-form" = "/admin/structure/entities_section/add",
 *     "edit-form" = "/admin/structure/entities_section/{entities_section}/edit",
 *     "delete-form" = "/admin/structure/entities_section/{entities_section}/delete",
 *     "collection" = "/admin/structure/entities_section",
 *   }
 * )
 */
class Section extends ConfigEntityBase implements SectionInterface {

  /**
   * The Section ID.
   */
  protected ?string $id = NULL;

  /**
   * The section label.
   */
  protected ?string $label = NULL;

  /**
   * URL pattern.
   */
  protected ?string $urlPattern = NULL;

  /**
   * Color ( HEX format ).
   */
  protected ?string $color = NULL;

  /**
   * @inheritdoc
   */
  public function getUrlPattern(): string|NULL {
    return $this->urlPattern;
  }

  /**
   * @inheritdoc
   */
  public function getColor(): string|NULL {
    return $this->color;
  }

  /**
   * @inheritDoc
   */
  public function setUrlPattern(string $pattern): SectionInterface {
    $this->urlPattern = $pattern;
    return $this;
  }

  /**
   * @inheritdoc
   */
  public function setColor(string $color): SectionInterface {
    $this->color = $color;
    return $this;
  }

}