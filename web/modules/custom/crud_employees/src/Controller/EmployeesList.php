<?php

namespace Drupal\crud_employees\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

class EmployeesList extends ControllerBase {

  public function __construct(
    protected Connection $database
  ) {}

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database')
    );
  }

  public function __invoke(): array {
    $query = $this->database->select('employees_data', 'e')
      ->fields('e')
      ->execute();

    $employees_data = $query->fetchAll();

    if (!$employees_data) {
      return [
        '#markup' => $this->t('<h3>no employees registered</h3>'),
      ];
    }

    // dropbutton element
    $options['dropbutton'] = [
      '#type' => 'dropbutton',
      '#links' => [
        'edit' => [
          'title' => $this->t('Edit'),
          'url' => Url::fromRoute('employees.list'),
        ],
        'delete' => [
          'title' => $this->t('Delete'),
          'url' => Url::fromRoute('employees.list'),
        ],
      ],
    ];

    // transform a renderable array into HTML output
    $render = \Drupal::service('renderer');
    $dropbutton = $render->render($options);

    // transforming to an array of arrays
    $rows = [];
    foreach ($employees_data as $employee) {
      // object to array
      $employee = (array) $employee;
      // push dropbutton
      $employee['options'] = $dropbutton;
      // save
      $rows[] = $employee;
    }

    $table['employees'] = [
      '#type' => 'table',
      '#header' => [
        'Number',
        'Fist Name',
        'Last Name',
        'Email',
        'Office Code',
        'Job Title',
        'Options',
      ],
      '#rows' => $rows,
    ];

    return $table;
  }

}
