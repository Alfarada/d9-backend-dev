<?php

namespace Drupal\ja_plugins\Plugin\Fipsum;

use Drupal\ja_plugins\FipsumBase;

/**
 * Provides a LoremIpsum text.
 *
 * @Fipsum(
 *    id = "lorem_ipsum",
 *    description = @Translation("Lorem Ipsum Text")
 * )
 */

class LoremIpsum extends FipsumBase {
  public function generate($length = 100) : string {
    return substr(file_get_contents('http://loripsum.net/api/1/verylong/plaintext'), 0, $length) . '.';
  }
}
