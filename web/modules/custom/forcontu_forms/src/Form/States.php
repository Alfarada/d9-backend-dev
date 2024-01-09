<?php

namespace Drupal\forcontu_forms\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class States extends FormBase {

  public function getFormId(): string {
    return 'forcontu_form_state';
  }

  public function buildForm(array $form, FormStateInterface $form_state): array {
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#required' => TRUE,
      '#default_value' => ''
    ];

    $form['unlock_options'] = [
      '#type' =>'checkbox',
      '#title' => $this->t('Check to unlock more options')
    ];

    $form['options'] = [
      '#type' =>'container',
      '#states' => [
        'visible' => [
          ':input[name="unlock_options"]' => ['checked' => TRUE],
        ]
      ]
    ];

    $form['options']['color'] = [
      '#type' => 'select',
      '#title' => $this->t('Color'),
      '#options' => [
        'none' => $this->t('None'),
        'black' => $this->t('Black'),
        'red' => $this->t('Red'),
        'blue' => $this->t('Blue'),
        'other' => $this->t('Other color'),
      ],
      '#description' => $this->t('Choose a color.'),
    ];

    $form['options']['color_name'] = [
      '#type' => 'textfield',
      '#size' => 50,
      '#title' => $this->t('Color name'),
      '#description' => $this->t('Write the color name'),
      '#states' => [
        'visible' => [
          ':input[name="color"]' => ['value' => 'other'],
        ],
        'required' => [
          ':input[name="color"]' => ['value' => 'other'],
        ],
      ],
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state): void {
    // TODO: Implement submitForm() method.
  }

}