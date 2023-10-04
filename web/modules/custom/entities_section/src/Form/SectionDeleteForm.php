<?php

namespace Drupal\entities_section\Form;

use Drupal\Core\Url;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\EntityConfirmFormBase;
use Drupal\Core\StringTranslation\TranslatableMarkup;

class SectionDeleteForm extends EntityConfirmFormBase {

  /**
   * @inheritDoc
   */
  public function getQuestion(): TranslatableMarkup {
    return $this->t('Are you sure you want to delete %name?', ['%name' => $this->entity->label()]);
  }

  /**
   * @inheritDoc
   */
  public function getCancelUrl(): Url {
    return new Url('entity.entities_section.collection');
  }

  public function getConfirmText(): TranslatableMarkup {
    return $this->t('Delete');
  }

  /**
   * @throws \Drupal\Core\Entity\EntityStorageException
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
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