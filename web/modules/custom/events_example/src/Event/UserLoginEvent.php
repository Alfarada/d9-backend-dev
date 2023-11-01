<?php

namespace Drupal\events_example\Event;

use Drupal\Component\EventDispatcher\Event;
use Drupal\user\UserInterface;

/**
 * Event that is fired when a user logs in.
 */
class UserLoginEvent extends Event {
  const USER_LOGIN = 'events_example_user_login';

  public function __construct(public UserInterface $account) {}
}