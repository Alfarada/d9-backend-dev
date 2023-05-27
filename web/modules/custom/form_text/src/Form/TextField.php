<?php

namespace Drupal\form_text\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class TextField extends FormBase {

  function getFormId() {
    return 'form_textfield';
  }

  function buildForm(array $form, FormStateInterface $form_state) {

    // TEXTFIELD

    $form['first_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First name'),
      '#required' => TRUE,
      '#size' => 40,
      '#maxlength' => 80,
//      '#description' => 'Your user name.',
//      '#default_value' => $this->t('Your first name'),
//      '#placeholder' => 'Your first name'
    ];

    // EMAIL

    $form['email'] = [
      '#type' => 'email',
      '#title' => 'User email',
//      '#description' => 'Your email.',
      '#required' => TRUE,
      '#size' => 40, // tamaño del campo de text
      '#maxlength' => 128, // tamaño de caracteres
//      '#pattern' => '@example.com'
//      '#placeholder' => 'User email'
    ];

    // TEXTAREA

    $form['description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Description'),
      '#cols' => 60,
      '#rows' => 5
    ];

    // NUMBER

    $form['age'] = [
      '#type' => 'number',
      '#title' => 'Age',
    ];

    $form['quantity'] = [
      '#type' => 'number',
      '#title' => 'Quantity',
      '#description' => 'Must be a Multiple of 5',
      '#min' => 0,
      '#max' => 100,
      '#step' => 5
    ];

    // PASSWORD

//    $form['pass'] = [
//      '#type' => 'password',
//      '#title' => 'Password',
//      '#size' => 40,
//      '#maxlength' => 64,
////      '#default_value' => '',
//    ];


    // PASSWORD CONFIRM

    // Si se usa la confirmacion de contraseña solo,
    // debe declararse solo una matriz de tipo
    // password_confirm

    $form['pass_confirm'] = [
      '#type' => 'password_confirm',
      '#title' => 'Password',
      '#size' => 40,
      '#maxlength' => 64,
      //      '#default_value' => '',
    ];

    // TEL

    $form['tel'] = [
      '#type' => 'tel',
      '#title' => 'Telephone number',
      '#size' => 30,
      '#maxlength' => 64,
      //      '#default_value' => '',
    ];

    // BODY

    $form['body'] = [
      '#type' => 'text_format',
      '#title' => 'Body',
      '#format' => 'full_html',
    ];

    // HIDDEN

    $form['hidden'] = [
      '#type' => 'hidden',
      '#value' => $this->getFormId(),
    ];



    return $form;
  }

  function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  function submitForm(array &$form, FormStateInterface $form_state) {
  }

}

