<?php

namespace Drupal\crud_employees\Form;

use Drupal\Core\Database\Connection;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class EmployeesDeleteForm extends FormBase {

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
    return 'crud_employees_delete_form';
  }

  public function employeeFullName(): string {
    $employee_id = $this->getRouteMatch()->getParameter('employee');
    $employee = $this->database->select('employees_data', 'e')
      ->fields('e', ['firstName', 'lastName'])
      ->condition('e.id', $employee_id)
      ->execute()
      ->fetchAssoc();

    return ucwords($employee['firstName'] . ' ' . $employee['lastName']);

  }
  public function buildForm(array $form, FormStateInterface $form_state): array {

    $form['delete_message'] = [
      '#markup' => $this->t(
        "<h4> Are you sure to delete the employee record <em style='color:red;'>{$this->employeeFullName()}</em> ? </h4>"),
    ];
    $form['actions'] = [
      '#type' => 'actions',
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Delete'),
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state): void {}

  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $employee_id = $this->getRouteMatch()->getParameter('employee');
    $this->database->delete('employees_data')
      ->condition('id', $employee_id)
      ->execute();

    $this->messenger()->addStatus($this->t('Employee successfully deleted'));
    $form_state->setRedirect('crud_employees.list');
  }

}
