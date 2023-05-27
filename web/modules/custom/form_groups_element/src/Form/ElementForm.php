<?php

namespace Drupal\form_groups_element\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ElementForm extends FormBase {

  function getFormId() {
    return 'form_groups_element';
  }

  function buildForm(array $form, FormStateInterface $form_state) {

    // Si está en un grupo de elementos de tipo contenedor desplegable
    // (acordion - details)  asignamos el tipo fielset y asignarle
    // TRUE/FALSE a la propiedad #open ( solo si es de tipo acordtion )

    $form['personal_data'] = [
//      '#type' => 'fieldset',
      '#type' => 'details',
      '#title' => $this->t('Personal Data'),
      '#description' => $this->t('Description examples ...'),
      '#open' => TRUE,
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
