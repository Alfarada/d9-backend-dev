<?php

namespace Drupal\example_views\Plugin\views\field;

use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\field\Boolean;
use Drupal\views\ResultRow;
use Drupal\views\ViewExecutable;
use Drupal\views\Plugin\views\display\DisplayPluginBase;
/**
 * Provides BooleanIcon field handler.
 *
 * @ViewsField("boolean_icon")
 */

class BooleanIcon extends Boolean {

  public function init(ViewExecutable $view, DisplayPluginBase $display, array &$options = NULL) {

    parent::init($view, $display, $options);

    $new_format = ['icon' => [ t('Icon')]];

    // adds new 'icon' format to set to existing attributes
    $this->formats = array_merge($this->formats, $new_format);
  }

  // configuration variable that sets the default value
  protected function defineOptions () {
    $options = parent::defineOptions();
    $options['type_icon_path_true'] = [
      'default' => '',
     ];

    return $options;
  }


  // adds the form that allows you to indicate the path of the icon, this field
  // is shown only when the icon format has been selected.
  public function buildOptionsForm (&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);

    $form['type_icon_path_true'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Icon path'),
      '#default_value' => $this->options['type_icon_path_true'],
      '#description' => $this->t('URI format public:// or private://'),
      '#states' => [
        'visible' => [
          'select[name="options[type]"]' => [
            'value' => 'icon',
          ],
        ],
      ],
    ];
  }

  public function render(ResultRow $values) {
    $value = $this->getValue($values);
    if ($this->options['type'] == 'icon') {
      $build = [
        '#theme' => 'image',
        '#uri' => $this->options['type_icon_path_true'],
        '#alt' => $this->t('Highlighted content'),
        '#title' => $this->t('Highlighted content'),
        '#width' => 16,
      ];
      return $value ? $build : NULL;
    }else{
      return parent::render($values);
    }
  }

}