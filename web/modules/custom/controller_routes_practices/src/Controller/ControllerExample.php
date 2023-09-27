<?php

namespace Drupal\controller_routes_practices\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Url;
use Drupal\node\NodeInterface;
use Drupal\user\UserInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ControllerExample extends ControllerBase {

  public function __construct(
    protected AccountInterface $current_user
  ) {}

  public static function create(ContainerInterface $container) {
    return new static($container->get('current_user'));
  }

  public function simple(): array {
    return [
      '#markup' => $this->t('Test a controller an route'),
    ];
  }

  public function calculator(int $var1, int $var2): array {
    $list = [];

    // no recommended
    // $list[] = $var1 . " + " . $var2 . " = " . $var1 + $var2;

    $list[] = $this->t(' @var1 + @var2 = @sum', [
      '@var1' => $var1,
      '@var2' => $var2,
      '@sum' => $var1 + $var2,
    ]);

    $output['calculator_list'] = [
      '#theme' => 'item_list',
      '#items' => $list,
      '#title' => $this->t('Operations:'),
    ];

    return $output;
  }

  public function user(UserInterface $user): array {
    $output = [];

    $list[] = $this->t('User id = @id', ['@id' => $user->id()]);
    $list[] = $user->label();
    $list[] = $user->getEmail();

    $output['user_details'] = [
      '#theme' => 'item_list',
      '#items' => $list,
      '#title' => $this->t('User details:'),
    ];
    return $output;
  }

  public function node(NodeInterface $node): array {
    $output = [];

    $list[] = $node->id();
    $list[] = $node->label();
    $list[] = strip_tags($node->get('body')->getValue()[0]['value']);

    $output['user_details'] = [
      '#theme' => 'item_list',
      '#items' => $list,
      '#title' => $this->t('Node details:'),
    ];

    return $output;
  }

  public function urlLink(): array {
    $build = [];

    // enlace a una url interna
    $url1 = Url::fromRoute('block.admin_display');
    $link1 = Link::fromTextAndUrl(t('estructura de bloques'), $url1);
    $list[] = $link1;

    // enlace dentro de un contenido
    $link2 = Link::fromTextAndUrl(t('bloque'), $url1);
    $list[] = $this->t('Este es un ejemplo de como incluir un enlace de @param en un contenido', ['@param' => $link2->toString()]);

    // enlace a pagina de inicio
    $url3 = Url::fromRoute('<front>');
    $link3 = Link::fromTextAndUrl(t('Pagina principal'), $url3);
    $list[] = $link3;

    // enlace a un nodo
    $url4 = Url::fromRoute('entity.node.canonical', ['node' => 1]);
    $link4 = Link::fromTextAndUrl(t('nodo'), $url4);
    $list[] = $this->t('ver @node', ['@node' => $link4->toString()]);

    // enlace externo
    $url5 = Url::fromUri('https://www.drupal.org/');
    $link5 = Link::fromTextAndUrl(t('Drupal.org'), $url5);
    $list[] = $this->t('Enlace externo @external', ['@external' => $link5->toString()]);

    // enlace con atributos

    $url6 = Url::fromUri('https://www.youtube.com/');
    $link6_optiones = [
      'attributes' => [
        'class' => ['external-link', 'list'],
      ],
      'target' => '_blanck',
      'title' => 'Go to Youtube.com',
    ];

    $url6->setOptions($link6_optiones);
    $link6 = Link::fromTextAndUrl(t('Youtube'), $url6);
    $list[] = $this->t('Enlace externo a @external', ['@external' => $link6->toString()]);

    $build['list_url_link'] = [
      '#theme' => 'item_list',
      '#items' => $list,
      '#list_type' => 'ol', // para cambiar a lista ordenada
      '#title' => $this->t('Lista de enlaces'),
      '#attributes' => [
        'class' => 'list-url-link',
        'reversed' => 'reversed', // para invertir la lista ordenada
      ],
    ];

    return $build;
  }

  public function linkMenu(): array {
    return ['#markup' => 'Lorem ipsum'];
  }

  public function tab1(): array {

    $output = '<p>' . $this->t('This is a content of tab1'). '</p>';

    if ($this->currentUser()->hasPermission('administer nodes')) {
      $output .= '<p>' . $this->t('This extra text is only displayed if the current user can administer modules'). '</p>';
    }

    return ['#markup' => $output];
  }

  public function tab2(): array {
    return ['#markup' => 'contenido de local task 2'];
  }

  public function tab3(): array {
    return ['#markup' => 'Mauris vel volutpat nunc. Praesent eget tempor ipsum, sed consectetur dolor. Maecenas vitae arcu urna. Suspendisse in dui semper, semper neque porta, tempor nibh. Duis rutrum efficitur diam, non fringilla metus feugiat et. Morbi placerat dui in tristique vestibulum. Nunc aliquam risus sed nunc luctus ullamcorper.'];
  }

  public function tab2a(): array {
    return ['#markup' => 'Contenido de la tab2a'];
  }

  public function tab2b(): array {
    return ['#markup' => 'Contenido de la tab2b'];
  }

  public function extratab(): array {
    return ['#markup' => 'Este es un contenido agregado a una pestaña a un grupo de pestañas existentes.'];
  }
}
