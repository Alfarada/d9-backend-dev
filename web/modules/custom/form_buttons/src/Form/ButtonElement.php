<?php

namespace Drupal\form_buttons\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class ButtonElement extends FormBase {

  function getFormId() {
    return 'form_button';
  }

  function buildForm(array $form, FormStateInterface $form_state) {

    // Para enviar formulario, tiene 2 propiedades obligatorias
    // #type | submit
    // #value | texto que se muestra en el boton submit
    //
    // #submit
    // Permite especificar una funcion de submit alternativa que será
    // llamada cuando se pulsa el botón, lo mas habitual es que es que
    // la nueva funcion del submit sea un metodo dentro de la misma clase
    // del formulario, podemos llamar de la siguiente manera:
    //
    // a) '#submit => [[$this, 'submitCustomForm']]
    // b) '#submit => ['::submitCustomForm']]
    //
    // #name | Permite indicar interno al botón, es util cuando tenémos varios
    // botones en el formulario y necesitamos saber que botón ha sido pulsado.

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Submit1',
    ];

    // se usa actions para agrupar, es una buena practica ya que nos facilita
    // la maquetacion y modificaciones que otros modulos puedan hacer en
    // nuestro formulario.

    $form['actions'] = [
      '#type' => 'actions',
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => 'Submit2',
    ];

    // El boton de tipo button tiene las siguientes propiedades
    // #value | texto que se muestra en el botón.
    // #limit_validation_errors
    // #name... leer mas en el libro ZZzzz..

    $form['actions']['preview'] = [
      '#type' => 'button',
      '#value' => 'Preview button'
    ];

    // Botón de tipo link
    $form['examples_link'] = [
      '#title' => 'Link button example',
      '#type' => 'link',
      '#attributes' => [
        'class' => [
          'button',
          'button--primary']
      ],
      '#url' => Url::fromRoute('form_groups_table.example'),
    ];

    return $form;
  }

  function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  function submitForm(array &$form, FormStateInterface $form_state) {
    // TODO: Implement submitForm() method.
  }

}
