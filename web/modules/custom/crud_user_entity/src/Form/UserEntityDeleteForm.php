<?php

namespace Drupal\crud_user_entity\Form;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserEntityDeleteForm extends FormBase {

  public function __construct(
    protected ?EntityTypeManagerInterface $entity_type
  ) { }

  public static function create(ContainerInterface $container): self {
    return new static(
      $container->get('entity_type.manager')
    );
  }
  public function getFormId(): string {
    return 'crud_user_entity_delete_form_id';
  }

  public function buildForm(array $form, FormStateInterface $form_state): array {
    return ['#markup' => $this->t('delete test')];
  }

  public function submitForm(array &$form, FormStateInterface $form_state): void {
  }
}

