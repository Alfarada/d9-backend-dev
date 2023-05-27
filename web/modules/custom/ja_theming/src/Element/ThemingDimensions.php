<?php
namespace Drupal\ja_theming\Element;
use Drupal\Core\Render\Element\RenderElement;
/**
 * Provides a render element to display a Dimensions item.
 *
 * @RenderElement("theming_dimensions")
 */
class ThemingDimensions extends RenderElement {
  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    $class = get_class($this);
    return [
      '#pre_render' => [
        [$class, 'preRenderThemingDimensions'],
      ],
      '#length' => NULL,
      '#width' => NULL,
      '#height' => NULL,
      '#unit' => 'cm.',
      '#theme' => 'theming_dimensions',
    ];
  }
  /**
   * Element pre render callback.
   */
  public static function preRenderThemingDimensions($element) {
    dpm($element);
    return $element;
  }
}
