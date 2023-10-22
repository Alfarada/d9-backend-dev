<?php

namespace Drupal\development_tools\Services;

class
Tools {

  /**
   * Convert a text from camelCase to Camel Case
   *
   * @param string $string
   *
   * @return string
   */
  public function toUcFirst(string $string): string {
    /*@TODO validation*/
    $outputString = preg_replace('/([a-z])([A-Z])/', '$1 $2', $string);
    return ucfirst($outputString);
  }

  /**
   * Convert each value of "camelCase" array to "Camel Case"
   * @param array $array
   *
   * @return array
   */
  public function arrayUcFirst(array $array): array {
    /*@TODO validation*/
    $array_formatted = [];
    foreach ($array as $value) {
      $array_formatted[] = ucfirst(preg_replace('/([a-z])([A-Z])/', '$1 $2', $value));
    }
    return $array_formatted;
  }

  /**
   * Sort each element of the array by id
   *
   * @param array $data
   *
   * @return array
   */
  public function sortById(array $data): array {
    $new_data = [];
    /* @ TODO  validate that each element is an object or an array*/
    foreach ($data as $value) {
      $new_data[$value->customerNumber] = (array) $value;
    }

    return $new_data;
  }
}