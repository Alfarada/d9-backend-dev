<?php

namespace Drupal\test_config_entity\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\test_config_entity\FooEntityInterface;

/**
 * Defines the foo entity entity type.
 *
 * @ConfigEntityType(
 *   id = "foo_entity",
 *   label = @Translation("Foo Entity"),
 *   label_collection = @Translation("Foo Entities"),
 *   label_singular = @Translation("foo entity"),
 *   label_plural = @Translation("foo entities"),
 *   label_count = @PluralTranslation(
 *     singular = "@count foo entity",
 *     plural = "@count foo entities",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\test_config_entity\FooEntityListBuilder",
 *     "form" = {
 *       "add" = "Drupal\test_config_entity\Form\FooEntityForm",
 *       "edit" = "Drupal\test_config_entity\Form\FooEntityForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "foo_entity",
 *   admin_permission = "administer foo_entity",
 *   links = {
 *     "collection" = "/admin/structure/foo-entity",
 *     "add-form" = "/admin/structure/foo-entity/add",
 *     "edit-form" = "/admin/structure/foo-entity/{foo_entity}",
 *     "delete-form" = "/admin/structure/foo-entity/{foo_entity}/delete"
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
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
class FooEntity extends ConfigEntityBase implements FooEntityInterface {

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
   * {@inheritdoc}
   */
  public function setColor($color) {
    $this->color = $color;
    return $this;
  }

}
