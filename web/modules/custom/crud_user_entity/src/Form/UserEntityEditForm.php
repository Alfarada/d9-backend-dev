<?php

namespace Drupal\crud_user_entity\Form;

use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\Form\{FormBase, FormStateInterface};
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\{EntityTypeManagerInterface, EntityInterface};

class UserEntityEditForm extends FormBase {

  private ?EntityInterface $user;

  public function __construct(
    protected ?EntityTypeManagerInterface $entity_type
  ) {}

  public static function create(ContainerInterface $container): self {
    return new static(
      $container->get('entity_type.manager')
    );
  }

  public function getFormId(): string {
    return 'crud_user_entity_edit_form_id';
  }

  public function buildForm(array $form, FormStateInterface $form_state): array|MessengerInterface {
    $user_id = $this->getRouteMatch()->getParameter('user');
    $user_storage = $this->entity_type->getStorage('user');
    $this->user = $user_storage->load($user_id);

    if (!$this->user) {
      return \Drupal::messenger()->addError('User could not be loaded');
    }

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#required' => TRUE,
      '#size' => 35,
      '#default_value' => $this->user->label(),
    ];

    $form['pass'] = [
      '#type' => 'password_confirm',
      '#required' => TRUE,
    ];

    $form['mail'] = [
      '#type' => 'email',
      '#title' => $this->t('User email'),
      '#required' => TRUE,
      '#size' => 35,
      '#default_value' => $this->user->getEmail(),
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#attributes' => [
        'class' => ['button--primary'],
      ],
      '#value' => $this->t('Save'),
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state): void {
    // set user properties
    $this->user->set('name', $form_state->getValue('name'));
    $this->user->set('mail', $form_state->getValue('mail'));
    $this->user->setPassword($form_state->getValue('pass'));
    $this->user->save();

    $this->messenger()->addStatus($this->t('User successfully updated'));
    $form_state->setRedirect('crud_user_entity.list');
  }

}
