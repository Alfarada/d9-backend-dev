<?php

namespace Drupal\events_example\EventSubscriber;

use Drupal\Core\Messenger\MessengerInterface;
use Drupal\events_example\Event\UserLoginEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ExampleEventsUsersSubscriber implements EventSubscriberInterface {

  public function __construct(protected MessengerInterface $messenger) {}

  public function onUserLogin(UserLoginEvent $event): void {
    $this->messenger->addStatus(__FUNCTION__);
    $this->messenger->addStatus(t("Welcome back, %username", ['%username' => $event->account->getAccountName()]));

  }
  /**
   * @inheritDoc
   */
  public static function getSubscribedEvents(): array {
    return [
      UserLoginEvent::USER_LOGIN => ['onUserLogin'],
    ];
  }

}