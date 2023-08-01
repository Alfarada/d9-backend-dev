<?php

namespace Drupal\crud_employees\Form;

use Drupal\Core\Database\Connection;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Form\{FormBase, FormStateInterface};
use Symfony\Component\DependencyInjection\ContainerInterface;

class EmployeesEditForm extends FormBase {

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
    protected Connection $database,
    protected RouteMatchInterface $route_match
  ) {}

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database'),
      $container->get('current_route_match')
    );
  }

  public function getFormId(): string {
    return 'employees_edit';
  }

  public function buildForm(array $form, FormStateInterface $form_state): array {
    $employee_id = $this->getRouteMatch()->getParameter('employee');
    $employee_data = $this->database->select('employees_data', 'e')
      ->fields('e')
      ->condition('e.id', $employee_id)
      ->execute()
      ->fetchAssoc();

    $form['first_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First Name'),
      '#size' => 20,
      '#required' => TRUE,
      '#default_value' => $employee_data['firstName']
    ];
    $form['last_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Last Name'),
      '#size' => 20,
      '#required' => TRUE,
      '#default_value' => $employee_data['lastName']
    ];
    $form['email'] = [
      '#type' => 'email',
      '#title' => 'Employee email',
      '#required' => TRUE,
      '#size' => 20,
      '#maxlength' => 128,
      '#default_value' => $employee_data['employeesEmail']
    ];
    $form['office_code'] = [
      '#type' => 'number',
      '#title' => 'Office code',
      '#required' => TRUE,
      '#default_value' => $employee_data['officeCode']
    ];

    $form['job_title'] = [
      '#type' => 'select',
      '#title' => $this->t('Job Tittle'),
      '#default_value' => $employee_data['jobTitle'], // spect 1,2,3 ...
      '#options' => self::JOB_OPTIONS,
      '#description' => 'Select Job',
      '#required' => TRUE,
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Edit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state): void {
    $first_name = $form_state->getValue('first_name');
    $last_name = $form_state->getValue('last_name');
    $job_title = $form_state->getValue('job_title');

    if (!$job_title) {
      $form_state->setErrorByName('job_title', $this->t('Please select a job title'));
    }

    if (strlen($first_name) < 3 || preg_match('/[0-9]/', $first_name) === 1) {
      $form_state->setErrorByName('first_name', $this->t('Your first name must contain at least 3 non-numeric characters '));
    }

    if (strlen($last_name) < 3 || preg_match('/[0-9]/', $last_name) === 1) {
      $form_state->setErrorByName('last_name', $this->t('Your last name must contain at least 3 non-numeric characters'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $field_values = $form_state->getValues();
    $employee_id = $this->getRouteMatch()->getParameter('employee');
    // insert values
    $this->database->update('employees_data')->fields([
      'firstName' => $field_values['first_name'],
      'lastName' => $field_values['last_name'],
      'employeesEmail' => $field_values['email'],
      'officeCode' => $field_values['office_code'],
      'jobTitle' => $field_values['job_title'],
    ])
      ->condition('id', $employee_id)
      ->execute();

    $this->messenger()->addStatus($this->t('Employee successfully updated'));
    $form_state->setRedirect('crud_employees.list');
  }

}
