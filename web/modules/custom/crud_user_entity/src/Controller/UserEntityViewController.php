<?php

namespace Drupal\crud_user_entity\Controller;

use Drupal\user\UserInterface;
use Drupal\Core\Controller\ControllerBase;

class UserEntityViewController extends ControllerBase {

  public function __invoke(UserInterface $user): array {

    $user_properties = [
      'id' => $user->id(),
      'name' => $user->getDisplayName(),
      'email' => $user->getEmail() ?? "doesn't have email",
      'status' => $user->get('status')->value,
      'created' => $user->getCreatedTime(),
      'changed' => $user->getChangedTime()
    ];
    $output['user_details'] = [
      '#theme' => 'view_user_entity',
      '#attached' => [
        'library' => ['crud_user_entity/js_table']
      ],
      '#user' => $user_properties,
      '#title' => $this->t('Details ') . $user->label(),
    ];

    return $output;
  }

}