<?php

namespace Drupal\ja_theming\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;

class JaThemingController extends ControllerBase {

  public function render() {
    //definición del array $build

    $build['ja_theming_markup'] = [
      '#markup' => '<p>' . 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' . '</p>',
    ];

    $header = ['Column 1', 'Column 2', 'Column 3'];

    $rows[] = ['A', 'B', 'C'];
    $rows[] = ['D', 'E', 'F'];

    $build['ja_theming_table'] = [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];

    $list = ['Item 1', 'Item 2', 'Item 3'];
    $build['ja_theming_list'] = [
      '#theme' => 'item_list',
      '#title' => $this->t('List of items'),
      '#list_type' => 'ol',
      '#items' => $list,
    ];

    // un array  renderizable puede tener elementos hijos
    $build['children_elements'] = [
      'container' => [
        '#prefix' => '<div id="container" class="ja-theming">',
        '#attached' => [
          'library' => [
            'ja_theming/ja_theming.css',
          ],
        ],
        '#suffix' => '</div>',
        '#markup' => $this->t('This is a container div'),
        'list' => [
          '#theme' => 'item_list',
          '#title' => $this->t('List of items'),
          '#list_type' => 'ol',
          '#items' => $list,
        ],
      ],
    ];

    // Este elemento renderisable nos puede servir para
    // agregar opciones a operaciones crud de manera mas
    // sencilla.

    $build['dropbutton'] = [
      '#type' => 'dropbutton',
      '#links' => [
        'view' => [
          'title' => $this->t('View'),
          'url' => Url::fromRoute('ja_theming.example'),
        ],
        'edit' => [
          'title' => $this->t('Edit'),
          'url' => Url::fromRoute('ja_theming.example'),
        ],
        'delete' => [
          'title' => $this->t('Delete'),
          'url' => Url::fromRoute('ja_theming.example'),
        ],
      ],
    ];

    // se puede definir la propiedad title pero por
    // defecto usa 'More'
    $build['more_link'] = [
      '#type' => 'more_link',
      //      '#title' => 'Saber mas ...',
      '#url' => Url::fromRoute('ja_theming.example'),
    ];

    // toolbar_item se usa dentro de una implementacion de
    // hook_toolbar() para añadir enlaces adicionales a
    // la barra de herramientas de administración,
    // no se trata de elementos de menu si no de propiedades
    // adicionales

    // html_tag
    //Permite añadir cualquier etiqueta HTML (#tag), con sus atributos (#attributes) y valor (#value). Por
    //ejemplo:

    $color = '#ffeb3b';
    $build['html_tag'] = [
      '#type' => 'html_tag',
      '#tag' => 'p',
      '#value' => $this->t('The content area color has been changed to @code', [
        '@code' => $color,
      ]),
      '#attributes' => [
        'style' => 'background-color: ' . $color,
      ],
    ];

    // status message
    $build['status_messages'] = [
      '#type' => 'status_messages',
    ];

    // view
    // renderiza una vista, investigar mas acerca de este render array
    $build['view'] = [
      '#prefix' => '<div class="view-comments_recent">',
      '#suffix' => '</div>',
      '#type' => 'view',
      '#name' => 'comments_recent',
      '#display_id' => 'block_1',
      '#embed' => TRUE,
    ];

    // inline_template

    //Las propiedades disponibles son:
    //-
    //-
    //#template. Código Twig que hará de plantilla in-line.
    //#context. Array con las variables a sustituir en la plantilla. Estas variables pueden ser una
    //cadena o un array renderizable (elemento hijo que se renderizará primero y luego se sustituirá
    //su HTML en la plantilla).

    $build['inline_template'] = [
      '#type' => 'inline_template',
      '#template' => '<div class="block-filter-text-source">{{ label }}</div>',
      '#context' => [
        'label' => $this->t('Inline template example')
      ],
    ];

    // para duplicar una linea de código ctrl + d .
    return $build;
  }

}
