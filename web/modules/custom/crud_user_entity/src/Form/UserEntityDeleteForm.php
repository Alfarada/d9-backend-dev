<?php

namespace Drupal\crud_user_entity\Form;

use Drupal\Core\Url;
use Drupal\user\UserInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\Form\{ConfirmFormBase, FormStateInterface};
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserEntityDeleteForm extends ConfirmFormBase {

  private ?UserInterface $user;

  public function __construct(
    protected ?EntityTypeManagerInterface $entity_type
  ) {}

  public static function create(ContainerInterface $container): self {
    return new static(
      $container->get('entity_type.manager')
    );
  }

  public function getFormId(): string {
    return 'crud_user_entity_delete_form_id';
  }

  public function buildForm(array $form, FormStateInterface $form_state, UserInterface $user = NULL): array {
    $this->user = $user;
    return parent::buildForm($form, $form_state);
  }

  public function getQuestion(): TranslatableMarkup {
    return $this->t("Are you sure you want to delete user '%title' (nid: %nid ) from <em>crud_user_entity</em> table?",
      ['%title' => $this->user->label(), '%nid' => $this->user->id()]);
  }

  public function getCancelUrl(): Url {
    return new Url('crud_user_entity.list');
  }

  public function getCancelText(): TranslatableMarkup {
    return $this->t('Dont\' delete');
  }

  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $this->user->delete();
    $this->messenger()->addStatus($this->t('User successfully deleted'));
    $form_state->setRedirect('crud_user_entity.list');
  }
}
