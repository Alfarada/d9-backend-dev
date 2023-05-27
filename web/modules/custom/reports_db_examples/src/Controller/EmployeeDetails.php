<?php

namespace Drupal\reports_db_examples\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Reports db examples routes.
 */
class EmployeeDetails extends ControllerBase {

  /**
   * Builds the response.
   */
  public function show($id) {

    $con = \Drupal\Core\Database\Database::getConnection('default', 'db_test');
    $query = $con->select('offices', 'o')
      ->fields('o')
      ->condition('officeCode', $id);
    $result = $query->execute();

    $header = [
      'City ',
      'phone',
      'addres line 1',
      'addres line 2',
      'sate',
      'country',
      'postalCode',
      'territory'
    ];

    $rows = [];

    foreach ($result as $record) {
      $rows[] =  [
        $record->city,
        $record->phone,
        $record->addressLine1,
        $record->addressLine2,
        $record->state,
        $record->contry,
        $record->postalCode,
        $record->territory
      ];
    }

    $table['employee_office_details'] = [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];

    return $table;
  }
}
