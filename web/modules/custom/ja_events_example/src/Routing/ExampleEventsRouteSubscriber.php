<?php

namespace Drupal\ja_events_example\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

class ExampleEventsRouteSubscriber extends RouteSubscriberBase {

  /**
   * @inheritDoc
   */
  protected function alterRoutes(RouteCollection $collection) {
    // change the route '/user/login' to 'private'
    if ($route = $collection->get('user.login')) {
      $route->setPath('/private');
    }

    // Deny access to the user profile page
    if ($route = $collection->get('entity.user.canonical')) {
      $route->setRequirement('_access', 'FALSE');
    }
  }

}