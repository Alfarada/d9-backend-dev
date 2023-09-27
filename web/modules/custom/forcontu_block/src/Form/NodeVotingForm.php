<?php

namespace Drupal\forcontu_block\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\mysql\Driver\Database\mysql\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a Forcontu block form.
 */
class NodeVotingForm extends FormBase {

  protected $database;
  protected $currentUser;
  protected $currentRouteMatch;

  public function __construct(?Connection $database, ?AccountInterface $currentUser, ?RouteMatchInterface $currentRouteMatch) {
     $this->database = $database;
     $this->currentUser = $currentUser;
     $this->currentRouteMatch = $currentRouteMatch;
  }

  public static function create(ContainerInterface $container): self {

    return new static(
      $container->get('database'),
      $container->get('current_user'),
      $container->get('current_route_match')
    );
  }

  public function getFormId() {
    return 'forcontu_block_node_voting_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {

    $node_vote = NULL;
    $node = $this->currentRouteMatch->getParameter('node');

    $nid = $node ? $node->id() : NULL;

    if ($nid && $this->currentUser->isAuthenticated()) {
      $node_vote = $this->database->select('forcontu_node_votes', 'f')
        ->fields('f', ['vote'])
        ->condition('f.nid', $nid)
        ->condition('f.uid', $this->currentUser()->id())
        ->execute()
        ->fetchField();
    }

    $form['node_vote'] = [
      '#type' => 'radios',
      '#title' => $this->t('Vote this node'),
      '#options' => [1 => 1, 2 => 2 , 3 => 3 , 4 => 4, 5 => 5],
      '#description' => $this->t('How to useful did you find this content?'),
      '#required' => TRUE,
      '#default_value' => $node_vote
    ];

    $form['nid'] = [
      '#type' => 'value',
      '#value' => $nid
    ];

    $form['uid'] = [
      '#type' => 'value',
      '#value' => $this->currentUser->id()
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Vote')
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state): void {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $uid = $form_state->getValue('uid');
    $nid = $form_state->getValue('nid');
    $node_vote = $form_state->getValue('node_vote');

    $upsert = $this->database->upsert('forcontu_node_votes')
      ->key('nid')
      ->fields(['nid', 'uid', 'vote'])
      ->values([
        'nid' => $nid,
        'uid' => $uid,
        'vote' => $node_vote,
      ])->execute();

    $this->messenger()->addMessage($this->t('Your vote on this node has been registered.'));
  }

}
