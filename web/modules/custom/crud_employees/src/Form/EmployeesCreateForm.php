<?php

namespace Drupal\crud_employees\Form;

use Drupal\Core\Database\Connection;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a CRUD Employees form.
 */
class EmployeesCreateForm extends FormBase {

  const JOB_OPTIONS = [
    '-None-',
    'President',
    'VP Sales',
    'VP Marketing',
    'Sales Manager (APAC)',
    'Sales Manager (NA)',
    'Sale Manager (EMEA)',
    'Sale Manager (Sales Rep)',
  ];

  public function __construct(
    protected Connection $database
  ) {}

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database')
    );
  }

  public function getFormId(): string {
    return 'crud_employees_create_form';
  }

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
      '#placeholder' => 'employee@gmail.com',
    ];
    $form['office_code'] = [
      '#type' => 'number',
      '#title' => 'Office code',
      '#required' => TRUE,
    ];

    $form['job_title'] = [
      '#type' => 'select',
      '#title' => $this->t('Job Tittle'),
      '#default_value' => self::JOB_OPTIONS[0],
      '#options' => self::JOB_OPTIONS,
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

  public function validateForm(array &$form, FormStateInterface $form_state): void {
    $first_name = $form_state->getValue('first_name');
    $last_name = $form_state->getValue('last_name');
    $job_title = $form_state->getValue('job_title');

    // select job title except "-none-"
    if (!$job_title) {
      $form_state->setErrorByName('job_title', $this->t('Please select a job title'));
    }

    // first name must be greater than or equal to three characters
    // must be a string and cannot be a numeric string
    if (strlen($first_name) < 3 || preg_match('/[0-9]/', $first_name) === 1) {
      $form_state->setErrorByName('first_name', $this->t('Your first name must contain at least 3 non-numeric characters '));
    }

    // same for second name
    if (strlen($last_name) < 3 || preg_match('/[0-9]/', $last_name) === 1) {
      $form_state->setErrorByName('last_name', $this->t('Your last name must contain at least 3 non-numeric characters'));
    }
  }

  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $field_values = $form_state->getValues();
    // insert values
    $this->database->insert('employees_data')->fields([
      'firstName' => $field_values['first_name'],
      'lastName' => $field_values['last_name'],
      'employeesEmail' => $field_values['email'],
      'officeCode' => $field_values['office_code'],
      'jobTitle' => $field_values['job_title'],
    ])->execute();

    $this->messenger()->addStatus($this->t('Employee successfully registered'));
    $form_state->setRedirect('employees.list');
  }

}
