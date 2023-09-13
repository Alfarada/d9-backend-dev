<?php

namespace Drupal\crud_user_entity\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class UserEntityForm extends FormBase {

  public function getFormId(): string {
    return 'crud_user_entity_form_id';
  }

  public function buildForm(array $form, FormStateInterface $form_state): array {
    return ['#markup' => $this->t('test')];
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    // TODO: Implement submitForm() method.
  }

}
