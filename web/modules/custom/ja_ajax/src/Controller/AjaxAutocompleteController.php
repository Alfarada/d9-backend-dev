<?php

namespace Drupal\ja_ajax\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use function PHPUnit\Framework\matches;

class AjaxAutocompleteController extends ControllerBase {

  public function userAutocomplete(Request $request): JsonResponse {
    $string = $request->query->get('q');
    $users = [ 'admin', 'foo', 'foobar', 'foobaz' ];
    $matches = preg_grep("/$string/i", $users);
    return new JsonResponse(array_values($matches));
  }
}