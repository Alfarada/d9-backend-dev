<?php

namespace Drupal\section_entity\Form;

use Drupal\Core\Entity\EntityConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class SectionDeleteForm extends EntityConfirmFormBase {
  public function getQuestion() {
    return $this->t('Are you sure you want to delete %name?', ['%name' => $this->entity->label()]);
}
  public function getCancelUrl() {
    return new Url('entity.section_entity.collection');
  }

  public function getConfirmText() {
    return $this->t('Delete');
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->entity->delete();
    $this->messenger()->addMessage(
      $this->t('content @type: deleted @label.',
        [ '@type' => $this->entity->bundle(),
          '@label' => $this->entity->label(),
        ])
    );
    $form_state->setRedirectUrl($this->getCancelUrl());
  }
}
