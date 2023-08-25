<?php

namespace Drupal\config_form_example\Form;

use Drupal\Core\Url;
use Drupal\node\Entity\Node;
use Drupal\node\NodeInterface;
use Drupal\Core\Database\Connection;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\Form\{ConfirmFormBase, FormStateInterface};
use Symfony\Component\DependencyInjection\ContainerInterface;

class ConfirmFormExample extends ConfirmFormBase {

  protected Node|NULL $node;

  public function __construct(
    protected ?Connection $database,
  ) {}

  public static function create(ContainerInterface $container): self {
    return new static(
      $container->get('database')
    );
  }

  public function getFormId(): string {
    return 'config_form_example_confirm';
  }

  public function buildForm(array $form, FormStateInterface $form_state, NodeInterface $node = NULL): array {
    $this->node = $node;
    return parent::buildForm($form, $form_state);
  }

  public function getQuestion(): TranslatableMarkup {
    return $this->t("Are you sure you want to delete node '%title' (%nid) from <em>config_form_example_node_highlighted</em> table?",
      ['%title' => $this->node->getTitle(), '%nid' => $this->node->id()]);
  }

  public function getCancelUrl(): Url {
    return new Url('<front>');
  }

  public function getCancelText(): TranslatableMarkup {
    return $this->t('Dont\' delete');
  }

  /**
   * {@inheritdoc}
   *
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *
   * @return \Drupal\Core\Form\FormStateInterface|void
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $query = $this->database->delete('config_form_example_highlighted')
      ->condition('nid', $this->node->id())
      ->execute();

    if ($query) {
      $this->messenger()->addMessage($this->t('The node  has been removed'));
      return $form_state->setRedirectUrl($this->getCancelUrl());
    }

    // warning if attempting to delete content that is not highlighted
    $this->messenger()->addWarning($this->t('This content is not highlighted.'));
    $form_state->setRedirectUrl(Url::fromRoute("config_form_example.confirm_form", ['node_id' => $this->node->id()]));
  }

}