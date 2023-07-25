<?php

namespace Drupal\crud_employees\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a CRUD Employees form.
 */
class EmployeesForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'crud_employees_id';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $form['first_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First Name'),
      '#size' => 20,
      '#required' => TRUE,
    ];
    $form['last_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Last Name'),
      '#size' => 20,
      '#required' => TRUE,
    ];
    $form['email'] = [
      '#type' => 'email',
      '#title' => 'Employee email',
      '#required' => TRUE,
      '#size' => 20,
      '#maxlength' => 128,
      '#pattern' => '@example.com',
      '#placeholder' => 'employee@gmail.com',
    ];
    $form['office_code'] = [
      '#type' => 'number',
      '#title' => 'Office code',
      '#required' => TRUE,
    ];

    $job_options = [
      $this->t('-None-'),
      $this->t('President'),
      $this->t('VP Sales'),
      $this->t('VP Marketing'),
      $this->t('Sales Manager (APAC)'),
      $this->t('Sales Manager (NA)'),
      $this->t('Sale Manager (EMEA)'),
      $this->t('Sale Manager (Sales Rep)'),
    ];

    $form['job_title'] = [
      '#type' => 'select',
      '#title' => $this->t('Job Tittle'),
      '#default_value' => $job_options[0],
      '#options' => $job_options,
      '#description' => 'Select Job',
      '#required' => TRUE,
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Send'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state): void {
    if (mb_strlen($form_state->getValue('message')) < 10) {
      $form_state->setErrorByName('message', $this->t('Message should be at least 10 characters.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $this->messenger()->addStatus($this->t('The message has been sent.'));
    $form_state->setRedirect('<front>');
  }

}
