<?php

namespace Drupal\config_form_example\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class ConfigFormExample extends ConfigFormBase {

  public function getFormId(): string {
    return 'config_form_example_config_example';
  }

  protected function getEditableConfigNames(): array {
    return ['config_form_example.settings'];
  }

  public function buildForm(array $form, FormStateInterface $form_state): array {

    $config = $this->config('config_form_example.settings');

    // content list
    $types = node_type_get_names();

    $form['config_form_allowed_types'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Content types allowed'),
      '#default_value' => $config->get('allowed_types'),
      '#options' => $types,
      '#description' => $this->t('Select content types.'),
      '#required' => TRUE
    ];

    $form['config_form_message'] = [
        '#type' => 'textarea',
        '#title' => t('Message'),
        '#cols' => 60,
        '#rows' => 5,
        '#default_value' => $config->get('message')
    ];

    return parent::buildForm($form, $form_state);
  }

  public function validateForm(array &$form, FormStateInterface $form_state): void {
    parent::validateForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state): void {

    // remove falsy values
    $allowed_types = array_filter($form_state->getValue('config_form_allowed_types'));
    // sort the array from smallest to largest
    sort($allowed_types);

    $this->config('config_form_example.settings')
      ->set('allowed_types', $allowed_types)
      ->set('message', $form_state->getValue('config_form_message'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
