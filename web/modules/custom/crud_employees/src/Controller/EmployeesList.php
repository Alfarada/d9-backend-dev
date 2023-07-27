<?php

namespace Drupal\crud_employees\Controller;

use Drupal\Core\Url;
use Drupal\Core\Database\Connection;
use Drupal\Core\Render\RendererInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\crud_employees\Form\EmployeesCreateForm;
use Symfony\Component\DependencyInjection\ContainerInterface;

class EmployeesList extends ControllerBase {

  public function __construct(
    protected Connection $database,
    protected RendererInterface $renderer
  ) {}

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database'),
      $container->get('renderer')
    );
  }

  public function __invoke(): array {
    $employees = $this->database->select('employees_data', 'e')
      ->fields('e')
      ->execute()
      ->fetchAll();

    if (!$employees) {
      return [
        '#markup' => $this->t('<h3>no employees registered</h3>'),
      ];
    }

    // transform to an array of arrays
    $employee_collection = [];
    foreach ($employees as $employee) {
      // build a dropbutton with the employee id
      $dropbutton = [
        '#type' => 'dropbutton',
        '#links' => [
          'edit' => [
            'title' => $this->t('Edit'),
            'url' => Url::fromRoute('crud_employees.edit',
              ['employee' => $employee->id]),
          ],
          'delete' => [
            'title' => $this->t('Delete'),
            'url' => Url::fromRoute('crud_employees.delete',
              ['employee' => $employee->id]),
          ],
        ],
      ];

      // convert object to array
      $employee = (array) $employee;
      // set current job title
      $employee['jobTitle'] = EmployeesCreateForm::JOB_OPTIONS[$employee['jobTitle']];
      // set dropbutton on the employee details
      // and renders array to convert it to HTML output
      $employee['dropbutton'] = $this->renderer->render($dropbutton);
      $employee_collection[] = $employee;
    }

    $table['employees'] = [
      '#type' => 'table',
      '#header' => [
        'ID',
        'Fist Name',
        'Last Name',
        'Email',
        'Office Code',
        'Job Title',
        'Options',
      ],
      '#rows' => $employee_collection,
    ];
    return $table;
  }

}
