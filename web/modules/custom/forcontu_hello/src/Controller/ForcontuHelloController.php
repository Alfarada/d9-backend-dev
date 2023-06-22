<?php

/**
 * @file
 * Contains \Drupal\forcontu_hello\Controller\ForcontuHelloController.
 */

namespace Drupal\forcontu_hello\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * controller to return content of defined pages
 */

class ForcontuHelloController extends ControllerBase {
    public function __invoke() : array {
        return [
            '#markup' => "<p> {$this->t('Hello, Forcontu This is my first module in drupal 9!')} </p>"
        ];
    }
}
