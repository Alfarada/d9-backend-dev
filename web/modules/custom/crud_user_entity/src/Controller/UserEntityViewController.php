<?php

namespace Drupal\crud_user_entity\Controller;

use Drupal\user\UserInterface;
use Drupal\Core\Controller\ControllerBase;

class UserEntityViewController extends ControllerBase {

  public function __invoke(UserInterface $user): array {
    $list = [];
    $list[] = $user->id();
    $list[] = $user->getDisplayName();
    $list[] = $user->getEmail() ?? "doesn't have email";
    $list[] = $user->get('status')->value;
    $list[] = $user->getCreatedTime();
    $list[] = $user->getChangedTime();

    $output['user_details'] = [
      '#theme' => 'item_list',
      '#items' => $list,
      '#title' => $this->t('Details ') . $user->label(),
    ];

    return $output;
  }

}