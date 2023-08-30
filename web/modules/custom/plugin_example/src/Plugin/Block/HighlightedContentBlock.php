<?php

namespace Drupal\plugin_example\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\Annotation\Block;
use Drupal\Core\Annotation\Translation;
use Drupal\Core\Database\Connection;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @Block(
 *   id="highlighted_content_block_example",
 *   admin_label= @Translation("Highlighted Content")
 * )
 */
class HighlightedContentBlock extends BlockBase implements ContainerFactoryPluginInterface {

  public function __construct(protected $configuration,
    protected $plugin_id,
    protected $plugin_definition,
    protected ?AccountInterface $current_user,
    protected ?Connection $database
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  public static function create(ContainerInterface $container,
    array $configuration,
    $plugin_id,
    $plugin_definition
  ): self {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_user'),
      $container->get('database'));
  }

  public function build(): array {
    // sets the number of nodes to show
    $node_number = $this->configuration['node_number'];
    $block_message = $this->configuration['block_message'];

    $build[] = [
      '#markup' => '<p>' . $this->t($block_message) . '</p>'
    ];

    $result = $this->database->select('config_form_example_highlighted', 'c')
      ->fields('c', ['nid'])
      ->condition('highlighted', 1)
      ->orderBy('nid', 'DESC')
      ->range(0, $node_number)
      ->execute();

    $list = [];
    $node_storage = \Drupal::entityTypeManager()->getStorage('node');

    foreach ($result as $record) {
      $node = $node_storage->load($record->nid);
      $list[] = $node->toLink($node->getTitle())->toRenderable();

    }

    if (empty($list)) {
      $build[] = [
        '#markup' => '<p>' . $this->t('This results not found') . '</p>',
      ];
    } else {
      $build[] = [
        '#theme' => 'item_list',
        '#items' => $list,
        '#cache' => ['max-age' => 0]
      ];
    }

    return $build;

  }

  public function blockForm($form, FormStateInterface $form_state): array {
    $form['block_message'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Display message'),
      '#default_value' => $this->configuration['block_message'],
    ];

    $range = range(1, 10);
    $form['block_node_number'] = [
      '#type' => 'select',
      '#title' => $this->t('Number of nodes'),
      '#default_value' => $this->configuration['node_number'],
      '#options' => array_combine($range, $range),
    ];

    return $form;
  }

  public function defaultConfiguration(): array {
    // the keys must be the same configuration keys and not the name of the form fields
    return [
      'block_message' => 'List of  highlighted nodes',
      'node_number' => 5,
    ];
  }

  public function blockValidate($form, FormStateInterface $form_state): void {
    if (strlen($form_state->getValue('block_message')) < 10) {
      $form_state->setErrorByName('block_message',
        $this->t('The text must be  at leaft 10 characters long'));
    }
  }

  public function blockAccess(AccountInterface $account): AccessResult {
    return AccessResult::allowedIfHasPermission($account, 'access content');
  }

  public function blockSubmit($form, FormStateInterface $form_state): void {
    $this->configuration['block_message'] = $form_state->getValue('block_message');
    $this->configuration['node_number'] = $form_state->getValue('block_node_number');
  }

}