<?php

namespace Drupal\ja_events_example\EventSubscriber;

use Drupal\Core\Config\{ConfigEvents, ConfigCrudEvent};
use Drupal\Core\Messenger\MessengerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ExampleEventsConfigSubscriber implements EventSubscriberInterface {

  public function __construct(protected MessengerInterface $messenger) {}

  public function onConfigSave(ConfigCrudEvent $event): void {
    $this->messenger->addStatus("Event: " . __FUNCTION__);
    $config = $event->getConfig();
    $this->messenger->addStatus("Config: " . $config->getName());
  }
  public function onConfigDelete(ConfigCrudEvent $event): void {
    $this->messenger->addStatus("Event: " . __FUNCTION__);
    $config = $event->getConfig();
    $this->messenger->addStatus("Config: " . $config->getName());
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents(): array {
    return [
      ConfigEvents::SAVE => ['onConfigSave'],
      ConfigEvents::DELETE => ['onConfigDelete'],
    ];
  }
}