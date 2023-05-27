<?php

namespace Drupal\forcontu_block\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Database\Connection;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides the HighlightedContent Block.
 *
 * @Block(
 *   id = "forcontu_blocks_highlighted_content_block",
 *   admin_label = @Translation("Highlighted Content"),
 *   category = @Translation("Forcontu Blocks"),
 * )
 */

class HighlightedContentBlock extends BlockBase  implements ContainerFactoryPluginInterface {

  protected $database;
  protected $currentUser;

  public function __construct(array $configuration,
                              $plugin_id,
                              $plugin_definition,
                              AccountInterface $currentUser,
                              Connection $database) {

    parent::__construct($configuration, $plugin_id, $plugin_definition);

    $this->currentUser = $currentUser;
    $this->database = $database;
  }

  public static function create(ContainerInterface $container,
                                array $configuration,
                                $plugin_id,
                                $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_user'),
      $container->get('database')
    );
  }

  public function build() {

    $node_number = $this->configuration['node_number'];
    $block_message = $this->configuration['block_message'];

    // 1
    // En el array $build definiremos varios elementos renderizables.
    // Al no tratarse de un formulario, no hemos incluido un índice para cada elemento ($build[]),
    // pero se podrían añadir
    $build[] = [
      '#markup' => '<h3>' . $this->t($block_message) . '</h3>',
    ];

    // 2a
    // Consulta a la base de datos para obtener el listado de nodos destacados
    // en la tabla creada en el modulo Forcontu Forms, el numero de nodos
    // se especifica a través del metodo range(), pasando como valor
    // la variable 'node_number' de la configuracion del bloque.

    $result = $this->database->select('forcontu_node_highlighted', 'f')
      ->fields('f', ['nid'])
      ->condition('highlighted', 1)
      ->orderBy('nid', 'DESC')
      ->range(0, $node_number)
      ->execute();
    // 2b
    // Para trabajar con los nodos (y otras entidades), utilizamos la clase EntityTypeManager.
    // En primer lugar se obtiene el almacén de objetos ($node_storage), que nos permitirá obtener nodos.

    // Nótese que la forma correcta de utilizar la clase entityTypeManager es mediante la inyección
    // del servicio entity_type.manager.

    $list = [];
    $node_storage = \Drupal::entityTypeManager()->getStorage('node');
    // 2c
    // Cargamos cada nodo obtenido ($node_storage->load()) y generamos un enlace con
    // el título del nodo. Cada valor se almacena en un array $list[]

    foreach($result as $record) {
      $node = $node_storage->load($record->nid); // cargamos el objeto del nodo especifico Drupal\node\Entity\Node
      $list[] = $node->toLink($node->getTitle())->toRenderable(); // convierte los links a una elemento renderizable y la almacena en una matriz de lista de elementos
    }
    if (empty($list)) {
      $build[] = [
        '#markup' => '<h3>' . $this->t('No results found') . '</h3>',
      ];
    } else {
      // 2d
      // Se crea el elemento renderizable con la plantilla 'item_list', que genera
      // un listado de elementos (<ul><li>). El array $list se pasa como valor del
      // atibuto '#items'. Aquí hemos añadido el atributo #cache para evitar que el contenido se cachee.
      $build[] = [
        '#theme' => 'item_list',
        '#items' => $list,
        '#cache' => ['max-age' => 0],
      ];
    }
    return $build;
  }

  public function blockForm($form, FormStateInterface $form_state) {
    $form['forcontu_blocks_block_message'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Display message'),
      '#default_value' => $this->configuration['block_message'],
    ];
    $range = range(1, 10);
    $form['forcontu_blocks_node_number'] = [
      '#type' => 'select',
      '#title' => $this->t('Number of nodes'),
      '#default_value' => $this->configuration['node_number'],
      '#options' => array_combine($range, $range),
    ];

    return $form;
  }

  public function blockValidate($form, FormStateInterface $form_state) {
    if (strlen($form_state->getValue('forcontu_blocks_block_message')) < 10) {
      $form_state->setErrorByName('forcontu_blocks_block_message',
        $this->t('The text must be at least 10 characters long'));
    }
  }

  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'access content');
  }

  public function blockSubmit($form, FormStateInterface $form_state) {
    // save configurations
    $this->configuration['block_message'] =
      $form_state->getValue('forcontu_blocks_block_message');
    $this->configuration['node_number'] =
      $form_state->getValue('forcontu_blocks_node_number');
  }

//  public function defaultConfiguration() {
//    return [
//      'block_message' => 'List of highlighted nodes',
//      'node_number' => 5,
//    ];
//  }

}
