<?php

namespace Drupal\message\Plugin\Field\FieldWidget;

use Drupal\Core\Annotation\Translation;
use Drupal\Core\Field\Annotation\FieldWidget;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'message_entities_text' widget.
 *
 * @FieldWidget(
 *   id = "message_entities_text",
 *   module = "message",
 *   label = @Translation("RGB value as #ffffff"),
 *   field_types={
 *     "message_entities_color"
 *   }
 * )
 */
class TextWidget extends WidgetBase {

  /**
   * @inheritDoc
   */
  public function formElement(FieldItemListInterface $items,
    $delta,
    array $element,
    array &$form,
    FormStateInterface $form_state): array {

    $value = $items[$delta]->value ?? '#ffffff';
    $element += [
      '#type' => 'textfield',
      '#default_value' => $value,
      '#size' => 7,
      '#maxlength' => 7
    ];

    return ['value' => $element];

  }

}