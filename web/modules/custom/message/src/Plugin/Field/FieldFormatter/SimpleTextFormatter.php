<?php

namespace Drupal\message\Plugin\Field\FieldFormatter;

use Drupal\Core\Annotation\Translation;
use Drupal\Core\Field\Annotation\FieldFormatter;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'message_entities_simple_text' formatter.
 *
 * @FieldFormatter(
 *   id = "message_entities_simple_text",
 *   module = "message",
 *   label = @Translation("Simple text-based formatter"),
 *   field_types={
 *     "message_entities_color"
 *   }
 * )
 */
class SimpleTextFormatter extends FormatterBase {

  /**
   * @inheritDoc
   */
  public function viewElements(FieldItemListInterface $items, $langcode): array {

    $elements = [];
    foreach ($items as $delta => $item) {
      $elements[$delta] = [
        '#type' => 'html_tag',
        '#tag' => 'p',
        '#attributes' => [
          'style' => 'color:' . $item->value
        ],
        '#value' => $this->t('The color code in this field is @code', ['@code'=> $item->value]),
      ];
    }

    return $elements;
  }

}