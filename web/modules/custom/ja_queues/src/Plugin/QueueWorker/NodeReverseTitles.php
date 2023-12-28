<?php

namespace Drupal\ja_queues\Plugin\QueueWorker;

use Drupal\Core\Annotation\QueueWorker;
use Drupal\Core\Queue\QueueWorkerBase;

/**
 * Defines 'node_reverse_titles' queue worker.
 *
 * @QueueWorker (
 *   id = "node_reverse_titles",
 *   title = @Translation ("Node Reverse Titles"),
 *   cron = { "time" = 5 }
 * )
 */

class NodeReverseTitles extends QueueWorkerBase {

  public function processItem(mixed $data): void {

    $id = $data['id'];
    $title = $data['title'];

    // invert characters
    $new_title = strrev($title);

    $storage = \Drupal::entityTypeManager()->getStorage('node');

    $node = $storage->load($id);
    $node->setTitle($new_title);
    $node->save();

    \Drupal::logger('ja_queues')->notice('Node @id has been processed.',
      ['@id' => $id]);

    sleep(1);
  }

}
