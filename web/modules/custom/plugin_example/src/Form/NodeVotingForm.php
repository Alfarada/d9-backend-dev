<?php

namespace Drupal\plugin_example\Form;

use Drupal\Core\Database\Connection;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Form\{FormBase, FormStateInterface};
use Symfony\Component\DependencyInjection\ContainerInterface;

class NodeVotingForm extends FormBase {

  public function __construct(
    protected ?Connection $database,
    protected ?AccountInterface $currentUser,
    protected ?RouteMatchInterface $currentRouteMatch
  ) {}

  public static function create(ContainerInterface $container): self {
    return new static(
      $container->get('database'),
      $container->get('current_user'),
      $container->get('current_route_match')
    );
  }

  public function getFormId(): string {
    return 'plugin_example_node_voting_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state): array {

    $node_vote = NULL;
    $form = [];
    $votes = range(1, 5);
    $node = $this->currentRouteMatch->getParameter('node');
    $nid = $node ? $node->id() : NULL;

    if ($nid && $this->currentUser->isAuthenticated()) {
      $node_vote = $this->database->select('plugin_example_node_votes', 'p')
        ->fields('p', ['vote'])
        ->condition('p.nid', $nid)
        ->condition('p.uid', $this->currentUser->id())
        ->execute()
        ->fetchField();

      $form['node_vote'] = [
        '#type' => 'radios',
        '#title' => $this->t('Node voting'),
        '#options' => array_combine($votes, $votes),
        '#description' => $this->t('How useful did you find this content ?'),
        '#required' => TRUE,
        '#default_value' => $node_vote
      ];

      $form['uid'] = [
        '#type' => 'value',
        '#value' => $this->currentUser->id()
      ];

      $form['nid'] = [
        '#type' => 'value',
        '#value' => $nid
      ];

      $form['submit'] = [
        '#type' => 'submit',
        '#value' => $this->t('Vote')
      ];
    }

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $nid = $form_state->getValue('nid');
    $uid = $form_state->getValue('uid');
    $node_vote = $form_state->getValue('node_vote');

    $upsert = $this->database->upsert('plugin_example_node_votes')
      ->key('nid')
      ->fields(['nid', 'uid', 'vote'])
      ->values([
        'nid' => $nid,
        'uid' => $uid,
        'vote' => $node_vote
      ])->execute();

    $this->messenger()->addMessage($this->t('Your vote on this node has been registered.'));
  }

}