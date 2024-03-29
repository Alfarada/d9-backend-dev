<?php

namespace Drupal\plugin_type_example\Plugin\Fipsum;

use Drupal\plugin_type_example\FipsumBase;

/**
 * Provides an ForcontuIpsum text.
 *
 * @Fipsum(
 *  id = "forcontu_ipsum",
 *  description = @Translation("Forcontu Ipsum text")
 * )
 */
class ForcontuIpsum extends FipsumBase {

  public function generate($length = 100) {
    $content = preg_replace('#<[^>]+>#', ' ', file_get_contents('https://www.forcontu.com/master-drupal-9'));
    $content = preg_replace('/\s+/', ' ', $content);
    $content = preg_replace('/[0-9\,\(\)]+/', '', $content);
    $content_array = explode(' ', $content);
    shuffle($content_array);
    return 'Forcontu ipsum ' . substr(implode(' ', $content_array), 0, $length) . '.';
  }

}