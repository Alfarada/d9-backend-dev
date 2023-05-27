<?php

namespace Drupal\form_groups_element\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ContainerForm extends FormBase {

  function getFormId() {
    return 'form_groups_container';
  }

  function buildForm(array $form, FormStateInterface $form_state) {

    $form['personal_data'] = [
      '#type' => 'container',
      '#title' => $this->t('Personal Data')
    ];

    $form['personal_data']['first_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First Name'),
      '#required' => TRUE,
      '#size' => 40,
    ];

    $form['personal_data']['last_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Last Name'),
      '#required' => TRUE,
      '#size' => 40,
    ];

    return $form;
  }

  function validateForm(array &$form, FormStateInterface $form_state)
  {
    parent::validateForm($form, $form_state);
  }

  function submitForm(array &$form, FormStateInterface $form_state)
  {
    // TODO: Implement submitForm() method.
  }
}

