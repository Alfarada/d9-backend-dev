<?php

namespace Drupal\form_select\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class SelectField extends FormBase {

  function getFormId() {
    return 'form_select';
  }

  function buildForm(array $form, FormStateInterface $form_state) {

    // SELECT

    $months = [
      1 => $this->t('January'),
      2 => $this->t('February'),
      3 => $this->t('March'),
      4 => $this->t('April'),
      5 => $this->t('May'),
      6 => $this->t('June'),
      7 => $this->t('July'),
      8 => $this->t('August'),
      9 => $this->t('September'),
      10 => $this->t('October'),
      11 => $this->t('November'),
      12 => $this->t('December'),
    ];

    // El valor 'n' equivale a la representación numérica del mes, sin ceros
    // iniciales.

    $form['months'] = [
      '#type' => 'select',
      '#title' => $this->t('Month'),
      '#default_value' => date('n'),
      '#options' => $months,
      '#description' => 'Select month',
    ];

    // CHECKBOXES

    $form ['todo'] = [
      '#markup' => '<h3>TODO | Añadir otro botón para seleccionar todas las opciones.</h3>',
    ];

    $form['colors'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Colors'),
      '#default_value' => ['red', 'green'],
      '#options' => [
        'red' => $this->t('Red'),
        'green' => $this->t('Green'),
        'blue' => $this->t('Blue'),
        'yellow' => $this->t('Yellow'),
      ],
      '#description' => $this->t('Select your preferred colors.')
    ];

    // RADIOS

    $form['day'] = [
      '#type' => 'radios',
      '#title' => $this->t('Day of the week'),
      '#options' => [
        1 => $this->t('Monday'),
        2 => $this->t('Tuesday'),
        3 => $this->t('Wednesday'),
        4 => $this->t('Thursday'),
        5 => $this->t('Friday'),
        6 => $this->t('Saturday'),
        7 => $this->t('Sunday'),
      ],
      '#description' => $this->t('Choose the day of the week.'),
      '#default_value' => date('N'),
    ];

    // CHECKBOX

    // El parámetro #return_value se puede utilizar
    //para especificar el valor que será devuelto cuando se selecciona el elemento. El valor por defecto es 1

    $form['legal_notice'] = [
      '#type' => 'checkbox',
      '#title_display' => 'before',
      '#title' => $this->t('Terminos y condiciones.'),
      '#description' => 'Acepta si está de acuerdo con las politicas de la empresa.',
    ];

    // RADIO

    // Crea un botón de selección individual de tipo radio. A diferencia del checkbox, una vez seleccionado, no
    // se puede deseleccionar.
    // El parámetro #return_value se puede utilizar para especificar el valor que será devuelto cuando se
    // selecciona el elemento. El valor por defecto es 1. En el ejemplo, al seleccionar el elemento, el valor
    // devuelto será "accept", tal y como hemos especificado en #return_value

    // El valor por defecto de la propiedad #title_display es 'after', por lo que el título se muestra después
    // del selector

    // Hay que tener cuidado por que  esto modifica los estilos css en como se
    // muestra el titulo y el orden por lo que puede ser necesario agregar
    // una descripción.
    $form['accept'] = [
      '#type' => 'radio',
      //      '#title_display' => 'after',
      '#title' => $this->t('Accept the agreement'),
      '#default_value' => 'accept',
    ];

    // RANGE

    $form['quantity'] = [
      '#type' => 'range',
      '#title' => $this->t('Quantity'),
      '#min' => 0,
      '#max' => 10,
      '#description' => $this->t('Value between 0 and 10'),
    ];

    // TABLESELECT

    $header = [
      'uid' => $this->t('User ID'),
      'first_name' => $this->t('First Name'),
      'last_name' => $this->t('Last Name'),
    ];

    $options = [
      1 => ['uid' => 1, 'first_name' => 'Fran', 'last_name' => 'Gil'],
      2 => ['uid' => 2, 'first_name' => 'Laura', 'last_name' => 'Fornié'],
      3 => ['uid' => 3, 'first_name' => 'Mark', 'last_name' => 'Gil'],
    ];

    $form['users'] = [
      '#type' => 'tableselect',
      '#header' => $header,
      '#options' => $options,
      '#empty' => $this->t('No users found'),
      '#js_select' => FALSE // default TRUE
    ];

    return $form;
  }

  function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  function submitForm(array &$form, FormStateInterface $form_state) {
  }

}

