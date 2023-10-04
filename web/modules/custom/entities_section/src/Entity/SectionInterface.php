<?php

namespace Drupal\entities_section\Entity;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

interface SectionInterface extends ConfigEntityInterface {
  /**
   * Returns the URL pattern of the section.
   */
  public function getUrlPattern(): string|NULL;

  /**
   * Return the color of the section.
   *
   * @retunr string
   * Color in HEX format
   */
  public function getColor(): string|NULL;

  /**
   * Sets the section URL pattern.
   *
   * @param string $pattern
   *  The pattern URL
   *
   * @return $this
   */

  public function setUrlPattern(string $pattern): SectionInterface;

  /**
   * Sets the section Color.
   *
   * @param string $color
   *  Color in HEX format
   *
   * @return $this
   */
  public function setColor(string $color): SectionInterface;

}