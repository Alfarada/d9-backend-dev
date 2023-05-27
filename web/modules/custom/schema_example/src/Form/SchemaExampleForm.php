<?php

namespace Drupal\schema_example\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a Schema example form.
 */
class SchemaExampleForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'schema_form_example';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['schema'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Table name'),
      '#required' => TRUE,
      '#description' => $this->t('Este es un ejemplo con fines educativos de como generar una esquema dinamicamente con la API squema que nos ofrece el sistema'),
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Create'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (mb_strlen($form_state->getValue('schema')) < 5) {
      $form_state->setErrorByName('message', $this->t('The schema name must be at least 5 characters.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $name = $form_state->getValue('schema');
    $table_definition = [
      'description' => 'tabla creada dinámicamente con la API Schema',
      'fields' => [],
      'primary key' => [],
    ];

    // get object connection
    $schema = \Drupal::database()->schema();

    // make sure the table exists
    if (!$schema->tableExists($name)) {

      $table_definition['fields'] = [
        'uid' => [
          'type' => 'serial',
          'not null' => TRUE,
          'unsigned' => TRUE,
        ],
        'field_example' => [
          'type' => 'varchar',
          'length' => 255,
          'not null' => TRUE,
          'description' => 'test',
        ],
      ];

      $table_definition['primary key'] = ['uid'];

      // create table
      $schema->createTable($name, $table_definition);
      return $this->messenger()
        ->addStatus($this->t('The table has been created'));
    }

    $this->messenger()->addError($this->t('This table already exist'));
    //    $form_state->setRedirect('<front>');
  }

}
