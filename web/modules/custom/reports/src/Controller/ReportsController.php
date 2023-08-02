<?php

namespace Drupal\reports\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Link;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Url;
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
    $fields = ['customerNumber', 'customerName', 'contactFirstName', 'contactLastName', 'phone'];
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
      '#header' => $fields,
      '#rows' => $rows
    ];

    return $table;
  }

  public function customersDetails(): array {
    // get url parametter
    $customer_id = $this->route_match->getParameter('customer');

    // conect to test database
    // connect to test database
    $database = Database::getConnection('default', 'db_test');
    // $fields = ['customerNumber', 'customerName', 'contactFirstName', 'contactLastName', 'phone'];
    $customers = $database->select('customers', 'c')
      ->fields('c')
      ->execute()
      ->fetchAssoc();

    $list = [];
    foreach ($customers as $key => $customer) {
      $list[] = $this->t("<strong>$key</strong>: $customer");
    }

    $output['customer_details_list'] = [
      '#theme' => 'item_list',
      '#items' => $list,
      '#title' => $this->t('Details'),
    ];

    return $output;
  }


}
