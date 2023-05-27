<?php

namespace Drupal\forcontu_pages\Controller;

use Drupal;
use Drupal\Core\{Link, Url};
use Drupal\user\UserInterface;
use Drupal\Core\Session\AccountProxy;
use Drupal\Core\Controller\ControllerBase;
use Drupal\mysql\Driver\Database\mysql\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ForcontuPagesController extends ControllerBase {

  protected $database;

  protected $currentUser;

  public function __construct(AccountProxy $current_user, Connection $database) {
    $this->currentUser = $current_user;
    $this->database = $database;

  }

  public static function create(ContainerInterface $container) {

    return new static($container->get('current_user'), $container->get('database'));

  }

  // alternative services injection
  // public static function create(ContainerInterface $container)
  // {

  //     $instance = parent::create($container);
  //     $instance->database = $container->get('database');
  //     $instance->currentUser = $container->get('current_user');
  //     return $instance;
  // }

  public function simple() {
    return [
      '#markup' => "<p> {$this->t('This is a simple page (with no arguments) ')} </p>",
    ];
  }

  public function user(UserInterface $user) {
    // Podemos usar directamente el objeto user
    $list[] = $this->t("Username: @username", ['@username' => $user->getAccountName()]);

    $list[] = $this->t("Email: @email", ['@email' => $user->getEmail()]);

    $list[] = $this->t("Roles: @roles", ['@roles' => implode(', ', $user->getRoles())]);

    $list[] = $this->t("Last accessed time: @lastaccess", [
        '@lastaccess' => Drupal::service('date.formatter')
          ->format($user->getLastAccessedTime(), 'short'),
      ]);

    $output['forcontu_pages_user'] = [
      '#theme' => 'item_list',
      '#items' => $list,
      '#title' => $this->t('User Data'),
    ];

    return $output;
  }

  public function links() {
    // link to /admin/structure/block
    $url1 = Url::fromRoute('block.admin_display');
    $link1 = Link::fromTextAndUrl(t('Go to the Block administration page'), $url1);
    $list[] = $link1;

    $list[] = $this->t('This text contains a link to %enlace. Just convert it to String it to use it into a text', ['%enlace' => $link1->toString()]);

    // link to <from>
    $url3 = Url::fromRoute('<front>');
    $link3 = Link::fromTextAndUrl(t('Go to the main page.'), $url3);
    $list[] = $link3;

    // link to /node/1
    $url4 = Url::fromRoute('entity.node.canonical', ['node' => 1]);
    $link4 = Link::fromTextAndUrl(t('Link to node/1'), $url4);
    $list[] = $link4;

    // link to edit /node/1
    $url5 = Url::fromRoute('entity.node.edit_form', ['node' => 1]);
    $link5 = Link::fromTextAndUrl(t('Link to edit node/1'), $url5);
    $list[] = $link5;

    // Link to http://localhost/d9/web
    $url6 = Url::fromUri('http://localhost/d9/web');
    $link6 = Link::fromTextAndUrl(t('Link to localhost'), $url6);
    $list[] = $link6;

    //link to https://www.drupal.org with extra attributes
    $url7 = Url::fromUri('http://localhost/d9/web');
    $link_options = [
      'attributes' => [
        'class' => [
          'external-link',
          'list',
        ],
        'target' => '_blank',
        'title' => 'Go to drupal.org',
      ],
    ];

    $url7->setOptions($link_options);
    $link7 = Link::fromTextAndUrl(t('Link to drupal.org with custom attributes'), $url7);
    $list[] = $link7;

    $output['forcontu_pages_links'] = [
      '#theme' => 'item_list',
      '#items' => $list,
      '#title' => $this->t('Examples of links:'),
    ];

    return $output;
  }

  public function calculator($num1, $num2) {
    // a) comprobamos que los valores sean numéricos
    // y si no es así lanzamos una excepción

    if (!is_numeric($num1) || !is_numeric($num2)) {
      throw new BadRequestHttpException(t('No numeric arguments specified.'));
    }

    // b) los resultados se mostrarán en formato lista HTML (ul)
    // cada elemento de la lista se añade a un array

    $list[] = $this->t(" @num1 + @num2 = @sum", [
        '@num1' => $num1,
        '@num2' => $num2,
        '@sum' => $num1 + $num2,
      ]);

    $list[] = $this->t(" @num1 - @num2 = @diference", [
        '@num1' => $num1,
        '@num2' => $num2,
        '@diference' => $num1 - $num2,
      ]);

    $list[] = $this->t(" @num1 x @num2 = @product", [
        '@num1' => $num1,
        '@num2' => $num2,
        '@product' => $num1 * $num2,
      ]);

    // c) evitar la division por cero
    if ($num2 != 0) {
      $list[] = $this->t("@num1 / @num2 = @division", [
          '@num1' => $num1,
          '@num2' => $num2,
          '@division' => $num1 / $num2,
        ]);
    }
    else {
      $list[] = $this->t("@num1 / @num2 = undefined (division by zero)", [
          '@num1' => $num1,
          '@num2' => $num2,
        ]);
    }

    // d) Se transforma el array $list en una lista HTML(ul)
    $output['forcontu_pages_calculator'] = [
      '#theme' => 'item_list',
      '#items' => $list,
      '#title' => $this->t('Operations:'),
    ];

    return $output;
  }

  public function tab1() {
    $output = '<p>' . $this->t('This is the content of tab 1') . '</p>';

    if ($this->currentUser->hasPermission('administer nodes')) {
      $output .= '<p>' . $this->t('This extra text is only displayed if the current user can administer nodes.') . '</p>';
    }

    return [
      '#markup' => $output,
    ];
  }

  public function tab2() {
    return [
      '#markup' => '<p>' . $this->t('This is the content of Tab 2') . '</p>',
    ];
  }

  public function tab3() {
    return [
      '#markup' => '<p>' . $this->t('This is the content of Tab 3') . '</p>',
    ];
  }

  public function tab3a() {
    return [
      '#markup' => '<p>' . $this->t('This is the content of Tab 3a') . '</p>',
    ];
  }

  public function tab3b() {
    return [
      '#markup' => '<p>' . $this->t('This is the content of Tab 3b') . '</p>',
    ];
  }

  public function extratab() {
    return [
      '#markup' => '<p>' . $this->t('This is the content of Extratab') . '</p>',
    ];
  }

  public function action1() {
    return [
      '#markup' => '<p>' . $this->t('This is the action1 link content example') . '</p>',
    ];
  }

  public function action2() {
    return [
      '#markup' => '<p>' . $this->t('This is the action2 link content example') . '</p>',
    ];
  }

}
