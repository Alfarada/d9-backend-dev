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
    return ['#markup' => $this->t('test')];
  }

}
