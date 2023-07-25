<?php

namespace Drupal\crud_employees\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
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

    $employees = $this->database->select('employees_data', 'e')
      ->fields('e')
      ->execute()
      ->fetchAssoc();

    if (!$employees) {
      return [
        '#markup' => $this->t('<h3>no employees registered</h3>')
      ];
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
      ],
      '#rows' => [$employees],
    ];

    return $table;
  }

}
