<?php

namespace Drupal\section_content\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\section_content\SectionEntityInterface;

/**
 * Defines the section entity entity type.
 *
 * @ConfigEntityType(
 *   id = "section_entity",
 *   label = @Translation("Section Entity"),
 *   handlers = {
 *     "list_builder" = "Drupal\section_content\SectionEntityListBuilder",
 *     "form" = {
 *       "add" = "Drupal\section_content\Form\SectionEntityForm",
 *       "edit" = "Drupal\section_content\Form\SectionEntityForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm"
 *     }
 *   },
 *   config_prefix = "section_entity",
 *   admin_permission = "administer section_entity",
 *   links = {
 *     "collection" = "/admin/structure/section-entity",
 *     "add-form" = "/admin/structure/section-entity/add",
 *     "edit-form" = "/admin/structure/section-entity/{section_entity}/edit",
 *     "delete-form" = "/admin/structure/section-entity/{section_entity}/delete"
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "urlPattern",
 *     "color"
 *   }
 * )
 */

class SectionEntity extends ConfigEntityBase implements SectionEntityInterface
{

  /**
   * The section entity ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The section entity label.
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
  public function getUrlPattern()
  {
    return $this->urlPattern;
  }

  /**
   * {@inheritdoc}
   */
  public function getColor()
  {
    return $this->color;
  }

  /**
   * {@inheritdoc}
   */
  public function setUrlPattern($pattern)
  {
    $this->urlPattern = $pattern;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setColor($color)
  {
    $this->color = $color;
    return $this;
  }
}