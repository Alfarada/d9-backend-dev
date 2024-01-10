<?php

namespace Drupal\ja_ajax\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class AutocompleteForm extends FormBase {

  public function getFormId(): string {
    return 'ja_ajax_ajax_autocomplete';
  }

  public function buildForm(array $form, FormStateInterface $form_state): array {
    $form['user'] = [
      '#type' => 'textfield',
      '#title' => 'Username',
      '#autocomplete_route_name' => 'ja_ajax.user_autocomplete',
    ];
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    // TODO: Implement submitForm() method.
  }

}