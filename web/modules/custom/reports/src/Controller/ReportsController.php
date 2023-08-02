<?php

namespace Drupal\reports\Controller;

use Drupal\Core\{Url, Link};
use Drupal\Core\Database\Database;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Routing\RouteMatchInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ReportsController extends ControllerBase {

  public function __construct(protected ?RouteMatchInterface $route_match) {}

  public static function create(ContainerInterface $container) {
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
      ->fields('c', $fields, '=')
      ->execute()
      ->fetchAll();

    $rows = [];
    foreach ($customers as $key => $customer) {
      // link to customer details
      $customer_url = Url::fromRoute('customers.details', ['customer' => $customer->customerNumber]);
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
    // get url parametter
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
}
