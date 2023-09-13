<?php

namespace Drupal\crud_user_entity\Form;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserEntityForm extends FormBase {

  public function __construct(
    protected ?EntityTypeManagerInterface $entity_type
  ) { }

  public static function create(ContainerInterface $container): self {
    return new static(
      $container->get('entity_type.manager')
    );
  }
  public function getFormId(): string {
    return 'crud_user_entity_form_id';
  }

  public function buildForm(array $form, FormStateInterface $form_state): array {
//    $users = $this->entity_type->getStorage('user');
//    $users_collection = $users->loadMultiple(NULL);

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#required' => TRUE,
      '#size' => 35
    ];

    $form['pass'] = [
      '#type' => 'password_confirm',
    ];

    $form['mail'] = [
      '#type' => 'email',
      '#title' => $this->t('User email'),
      '#required' => TRUE,
      '#size' => 35
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#attributes' => [
        'class' => ['button--primary']
      ],
      '#value' => $this->t('Save'),
    ];


    return $form;
  }

  /**
   * @throws \Drupal\Core\Entity\EntityStorageException
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $name = $form_state->getValue('name');
    $pass = $form_state->getValue('pass');
    $mail = $form_state->getValue('mail');

    $user_storage = $this->entity_type->getStorage('user');
    $new_user = $user_storage->create([
      'name' => $name,
      'pass' => $pass,
      'mail' => $mail
    ]);
    // save in storage
    $new_user->save();
    $this->messenger()->addStatus($this->t('User successfully registered'));
  }

}
