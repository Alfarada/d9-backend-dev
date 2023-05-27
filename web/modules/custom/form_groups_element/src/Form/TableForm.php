<?php

namespace Drupal\form_groups_element\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class TableForm extends FormBase {

  function getFormId() {
    return 'form_groups_table';
  }

  function buildForm(array $form, FormStateInterface $form_state) {

    // El elemento table puede utilizarse como elemento de formulario o simplemente como elemento de
    // presentación en un array renderizable. Construye una tabla donde, en cada celda, podemos colocar
    // cualquier tipo de elemento.

    $form['menbers'] = [
      '#type' => 'table',
      '#caption' => $this->t('Menbers'), // optional
      '#header' => [
        $this->t('ID'),
        $this->t('First Name'),
        $this->t('Last Name'),
      ],
    ];

    for ($i = 1; $i <= 3; $i++) {
      $form['menbers'][$i]['id'] = [
        '#type' => 'number',
        '#title' => 'ID',
        '#title_display' => 'invisible',
        '#default_value' => $i,
        '#disabled' => TRUE,
        '#size' => 30 // optional
      ];

      $form['menbers'][$i]['first_name'] = [
        '#type' => 'textfield',
        '#title' => 'First Name',
        '#title_display' => 'invisible',
        '#size' => 30, // optional
      ];

      $form['menbers'][$i]['last_name'] = [
        '#type' => 'textfield',
        '#title' => 'Last Name',
        '#title_display' => 'invisible',
        '#size' => 30   // optional
      ];

      dpm($form['menbers']);

      // Otra forma muy común de crear una tabla, como un elemento
      // representable.

      $rows = [];
      $data = [
        0 => ['id' => 0, 'first_name' => 'bob', 'last_name' => 'rank'],
        1 => ['id' => 1, 'first_name' => 'jarett', 'last_name' => 'seaman'],
        2 => ['id' => 2, 'first_name' => 'jeniffer', 'last_name' => 'pitarch'],
      ];

      foreach ($data as $key => $value) {
        $rows[$key] = [
          'ID' => [
            'data' => [
              '#markup' => $value['id'],
            ],
          ],
          'first_name' => [
            'data' => [
              '#markup' => $value['first_name'],
            ],
          ],
          'last_name' => [
            'data' => [
              '#markup' => $value['last_name'],
            ],
          ],
        ];
      }

      $form['menbers2'] = [
        '#type' => 'table',
        '#caption' => $this->t('Users'),
        '#header' => [
          'ID',
          'Fist Name',
          'Last Name',
        ],
        '#rows' => $rows,
      ];
    }

    // vertical_tabs

    // El elemento vertical_tabs se puede considerar un agrupador de agrupadores. Se utiliza para organizar
    // grupos de opciones en pestañas verticales. Como ejemplo de vertical_tabs, visita las opciones de
    // Visibilidad en la configuración de cualquier bloque

    $form['information'] = [
      '#type' => 'vertical_tabs',
    ];

    //    A continuación, se crean los grupos de elementos, añadiéndoles la propiedad #group con el nombre
    //    que le hemos dado al elemento vertical_tabs anterior. En nuestro ejemplo crearemos grupos de tipo
    //    details.

    $form['personal_data'] = [
      '#type' => 'details',
      '#title' => 'Personal data',
      '#description' => 'lorem ipsun dolor...',
      '#group' => 'information'
    ];

    // Y dentro de cada grupo, añadiremos sus elementos, exactamente igual que hemos hecho en los
    //ejemplos anteriores, en función del elemento agrupador utilizado.

    $form['personal_data']['first_name'] = [
      '#type' => 'textfield',
      '#title' => 'First Name',
      '#size' => 30, // optional
    ];

    $form['personal_data']['last_name'] = [
      '#type' => 'textfield',
      '#title' => 'Last Name',
      '#size' => 30, // optional
    ];

    $form['access_data'] = [
      '#type' => 'details',
      '#title' => $this->t('Access Data'),
      '#description' => $this->t('Curabitur non semper diam. Mauris faucibus eu augue vel semper.'),
      '#group' => 'information',
    ];

    $form['access_data']['user_email'] = [
      '#type' => 'email',
      '#title' => $this->t('User email'),
      '#required' => TRUE,
      '#size' => 32,
    ];

    $form['access_data']['password'] = [
      '#type' => 'password_confirm',
      '#title' => $this->t('Password'),
      '#title_display' => 'invisible',
      '#required' => TRUE,
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
