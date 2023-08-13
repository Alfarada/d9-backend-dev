<?php

namespace Drupal\reports\Controller;

use Drupal\Core\{Url, Link};
use Drupal\Core\Database\Database;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Routing\RouteMatchInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ReportsController extends ControllerBase {

  public function __construct(protected ?RouteMatchInterface $route_match) {}

  public static function create(ContainerInterface $container): ReportsController {
    return new static(
      $container->get('current_route_match')
    );
  }

  public function getCustomers(): array {
    // connect to test database
    $database = Database::getConnection('default', 'db_test');
    $fields = [
      'customerNumber',
      'customerName',
      'contactFirstName',
      'contactLastName',
      'phone',
    ];
    $customers = $database->select('customers', 'c')
      ->fields('c', $fields)
      ->execute()
      ->fetchAll();

    $rows = [];
    foreach ($customers as $key => $customer) {
      // link to customer details
      $customer_url = Url::fromRoute('reports.customers_details', ['customer' => $customer->customerNumber]);
      $customer_link = Link::fromTextAndUrl($customer->customerName, $customer_url);
      $customer->customerName = $customer_link;
      // convert to array
      $customer = (array) $customer;
      // set customers
      $rows[$key] = $customer;
    }

    $table['customers'] = [
      '#type' => 'table',
      '#header' => $this->arrayValueFormatterUcFirst($fields),
      '#rows' => $rows,
    ];

    return $table;
  }

  public function customersDetails(): array {
    // get url parameter
    $customer_id = $this->route_match->getParameter('customer');
    // connect to test database
    $database = Database::getConnection('default', 'db_test');
    $customer = $database->select('customers', 'c')
      ->fields('c')
      ->condition('customerNumber', $customer_id)
      ->execute()
      ->fetchAssoc();

    // customer properties list
    $list_properties = [];
    foreach ($customer as $property => $value) {
      $property = $this->camelCaseToUcFirst($property);
      $list_properties[] = $this->t("<strong>$property</strong>: $value");
    }

    $output['customer_details_list'] = [
      '#theme' => 'item_list',
      '#items' => $list_properties,
      '#title' => $this->t('Details'),
    ];

    return $output;
  }

  public function camelCaseToUcFirst(string $string): string {
    //validation
    $outputString = preg_replace('/([a-z])([A-Z])/', '$1 $2', $string);
    return ucfirst($outputString);
  }

  public function arrayValueFormatterUcFirst(array $array): array {
    //validation
    $array_formatted = [];
    foreach ($array as $value) {
      $array_formatted[] = ucfirst(preg_replace('/([a-z])([A-Z])/', '$1 $2', $value));
    }
    return $array_formatted;
  }

  public function getTotalPayments(): array {

    $database = Database::getConnection('default', 'db_test');

    $customers = $database->select('customers', 'c')
      ->fields('c', ['customerNumber', 'customerName'])
      ->execute()
      ->fetchAll();
    $customers = $this->reorder($customers);

    $times_paid = $database->select('payments', 'p');
    $times_paid->fields('p', ['customerNumber']);
    $times_paid->addExpression('COUNT(customerNumber)', 'total_payments');
    $times_paid->groupBy('customerNumber');
    $times_paid->having('COUNT(customerNumber) >= 1 ');
    $times_paid = $times_paid->execute()->fetchAll();
    $times_paid = $this->reorder($times_paid);

    $total_amount = $database->select('payments', 'p');
    $total_amount->fields('p', ['customerNumber']);
    $total_amount->addExpression('SUM(amount)', 'total_amount');
    $total_amount->groupBy('customerNumber');
    $total_amount = $total_amount->execute()->fetchAll();
    $total_amount = $this->reorder($total_amount);

    $data = [];
    foreach ($customers as $customer) {
      $data[$customer['customerNumber']] = [
        $customer['customerNumber'],
        $customer['customerName'],
        $times_paid[$customer['customerNumber']]['total_payments'],
        $total_amount[$customer['customerNumber']]['total_amount']
      ];
    }

    $table['customers'] = [
      '#type' => 'table',
      '#header' => [
        'Customer Number',
        'Customer Name',
        'Times Paid',
        'Total Amount',
        'Action'
      ],
      '#rows' => $data,
    ];
    return $table;
  }

  public function reorder(array $data): array {
    $new_data = [];
    foreach ($data as $value) {
      $new_data[$value->customerNumber] = (array) $value;
    }

    return $new_data;
  }
}
