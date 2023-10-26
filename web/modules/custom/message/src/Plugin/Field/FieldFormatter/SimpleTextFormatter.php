<?php

namespace Drupal\message\Plugin\Field\FieldFormatter;

use Drupal\Core\Annotation\Translation;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Field\{Annotation\FieldFormatter,
  FieldItemListInterface,
  FormatterBase};

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
        '#tag' => $this->getSetting('formatter_tag'),
        '#attributes' => [
          'style' => 'color:' . $item->value,
        ],
        '#value' => $this->t('The color code in this field is @code', ['@code' => $item->value]),
      ];
    }

    return $elements;
  }

  public function settingsForm(array $form, FormStateInterface $form_state): array {
    $output['formatter_tag'] = [
      '#title' => $this->t('HTML tag'),
      '#type' => 'select',
      '#options' => [
        'p' => $this->t('p'),
        'div' => $this->t('div'),
        'span' => $this->t('span'),
      ],
      '#default_value' => $this->getSetting('formatter_tag'),
    ];

    return $output;
  }

  public static function defaultSettings(): array {
    return [
        'formatter_tag' => 'p',
      ] + parent::defaultSettings();
  }

  public function settingsSummary(): array {
    $summary = [];
    $formatter_tag = $this->getSetting('formatter_tag');
    $summary[] = $this->t('HTML Tag: @tag', ['@tag' => $formatter_tag]);
    return $summary;
  }

}