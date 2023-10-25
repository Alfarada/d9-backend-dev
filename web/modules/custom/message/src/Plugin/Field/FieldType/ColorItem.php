<?php

namespace Drupal\message\Plugin\Field\FieldType;

use Drupal\Core\Field\{Annotation\FieldType,
  FieldItemBase,
  FieldStorageDefinitionInterface
};
use Drupal\Core\Annotation\Translation;
use Drupal\Core\TypedData\DataDefinition;

/**
 *  Plugin implementation of the 'message_entities_color' field type.
 *
 * @FieldType(
 *   id = "message_entities_color",
 *   label = @Translation("Message Color"),
 *   module = "message",
 *   description= @Translation("Field to store RGB color."),
 *   default_widget = "message_entities_text",
 *   default_formatter = "message_entities_simple_text"
 * )
 */
class ColorItem extends FieldItemBase {

  /**
   * @inheritDoc
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition): array {
    $properties['value'] = DataDefinition::create('string')->setLabel(t('Hex value'));
    return $properties;
  }

  /**
   * @inheritDoc
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition): array {
    return [
      'columns' => [
        'value' => [
          'type' => 'text',
          'size' => 'tiny',
          'not null' => FALSE,
        ],
      ],
    ];
  }

  /**
   * @inheritDoc
   */
  public function isEmpty(): bool {
    $value = $this->get('value')->getValue();
    return $value === NULL || $value === '';
  }

}