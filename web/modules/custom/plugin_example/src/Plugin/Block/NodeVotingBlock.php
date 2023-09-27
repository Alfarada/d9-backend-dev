<?php

namespace Drupal\plugin_example\Plugin\Block;

use Drupal\Core\Annotation\Translation;
use Drupal\Core\Block\Annotation\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @Block(
 *   id="plugin_example_node_voting_block",
 *   admin_label=@Translation("Node Voting")
 * )
 */
class NodeVotingBlock extends BlockBase implements ContainerFactoryPluginInterface {

  public function __construct(
    protected $configuration,
    protected $plugin_id,
    protected $plugin_definition,
    protected ?RouteMatchInterface $current_route_match,
    protected ?FormBuilderInterface $form_builder
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  public static function create(
    ContainerInterface $container,
    $configuration,
    $plugin_id,
    $plugin_definition
  ): self {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_route_match'),
      $container->get('form_builder')
    );
  }

  public function build(): array {
    return $this->form_builder->getForm('Drupal\plugin_example\Form\NodeVotingForm');
  }

}