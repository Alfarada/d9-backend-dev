<?php

namespace Drupal\section_content;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface defining a section entity entity type.
 */
interface SectionEntityInterface extends ConfigEntityInterface
{
    /**
     * Returns the URL pattern of the section.
     *
     * @return string
     *
    The URL pattern of the section*/
    public function getUrlPattern();
    /**
     * Returns the color of the section.
     *
     * @return string
     *
    Color in HEX format
     */
    public function getColor();
    /**
     * Sets the section URL pattern.
     *
     * @param string $pattern
     *
    The pattern URL
     *
     * @return $this
     */
    public function setUrlPattern($pattern);
    /**
     * Sets the section Color.
     *
     * @param string $color
     *
    Color in HEX format
     *
     * @return $this
     */
    public function setColor($color);
}