<?php

namespace Drupal\reports_db_examples\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Returns responses for Reports db examples routes.
 */
class Employees extends ControllerBase {

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $connection;

  /**
   * The controller constructor.
   *
   * @param \Drupal\Core\Database\Connection $connection
   *   The database connection.
   */
  public function __construct(Connection $connection) {
    $this->connection = $connection;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static($container->get('database'));
  }

  /**
   * Builds the response.
   */
  public function build() {

    // switch test database
    $con = \Drupal\Core\Database\Database::getConnection('default', 'db_test');
    $employees = $con->select('employees','e');
    $employees->join('offices','o', 'e.officeCode = o.officeCode');
    $employees->fields('o');
    $employees->fields('e');
    $result = $employees->execute();

    $header = [
      'Number',
      'employee',
      'Extension',
      'Email',
      'Reports To',
      'Job',
    ];

    $rows = [];

    foreach ($result as $record) {
      $rows[] = [
        $record->employeeNumber,
        [
          'data' => [
            '#theme' => 'reports_db_examples',
            '#object' => $record,
          ],
        ],
        $record->extension,
        $record->email,
        $record->reportsTo ?? 'none',
        $record->jobTitle,
      ];
    }

    $build['employee'] = [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];

    return $build;
  }

  private static function fullName(\stdClass $employee): Link {

    $full_name = $employee->firstName . ' ' . $employee->lastName;
    $url = Url::fromRoute('reports.employee_details', ['id' => $employee->officeCode]);

    return Link::fromTextAndUrl($full_name, $url);

  }

}
