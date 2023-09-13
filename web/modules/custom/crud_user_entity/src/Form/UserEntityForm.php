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

    $form['pass_confirm'] = [
      '#type' => 'password_confirm',
    ];

    $form['mail'] = [
      '#type' => 'email',
      '#title' => $this->t('User email'),
      '#required' => TRUE,
      '#size' => 35
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    // TODO: Implement submitForm() method.
  }

}
