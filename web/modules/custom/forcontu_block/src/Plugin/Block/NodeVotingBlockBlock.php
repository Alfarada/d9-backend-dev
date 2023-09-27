<?php

namespace Drupal\forcontu_block\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a nodevotingblock block.
 *
 * @Block(
 *   id = "forcontu_block_node_voting_block",
 *   admin_label = @Translation("Node Voting Block"),
 *   category = @Translation("Forcontu block")
 * )
 */
class NodeVotingBlockBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The form builder.
   *
   * @var \Drupal\Core\Form\FormBuilderInterface
   */
  protected $formBuilder;

  /**
   * The current route match.
   *
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected $routeMatch;

  /**
   * Constructs a new NodeVotingBlockBlock instance.
   *
   * @param array $configuration
   *   The plugin configuration, i.e. an array with configuration values keyed
   *   by configuration option name. The special key 'context' may be used to
   *   initialize the defined contexts by setting it to an array of context
   *   values keyed by context names.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Form\FormBuilderInterface|null $form_builder
   *   The form builder.
   * @param \Drupal\Core\Routing\RouteMatchInterface|null $route_match
   *   The current route match.
   */
  public function __construct(array $configuration,
                              $plugin_id, $plugin_definition,
                              ?FormBuilderInterface $form_builder,
                              ?RouteMatchInterface $route_match) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->formBuilder = $form_builder;
    $this->routeMatch = $route_match;
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition): self {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('form_builder'),
      $container->get('current_route_match')
    );
  }

  protected function blockAccess(AccountInterface $account): AccessResult {

    $node = $this->routeMatch->getParameter('node');

    if ($node && $account->isAuthenticated()) {
      return AccessResult::allowed();
    } else {
      return AccessResult::forbidden();
    }
  }

  public function build() {
    return $this->formBuilder->getForm('Drupal\forcontu_block\Form\NodeVotingForm');
  }

}
