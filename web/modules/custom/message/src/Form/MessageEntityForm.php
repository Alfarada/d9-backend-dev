<?php

namespace Drupal\message\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

class MessageEntityForm extends ContentEntityForm {

  public function save(array $form, FormStateInterface $form_state) {
    $entity = &$this->entity;
    $message_params = [
      '%entity_label' => $entity->id(),
      '%content_entity_label' => $entity->getEntityType()->getLabel()->render(),
      '%bundle_label' => $entity->bundle(),
    ];

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        $this->messenger()->addStatus($this->t('Created the %bundle_label - %content_entity_label entity:  %entity_label.', $message_params ));
        break;

      default:
        $this->messenger()->addStatus($this->t('Saved the %bundle_label - %content_entity_label entity:  %entity_label.', $message_params));
    }

    $content_entity_id = $entity->getEntityType()->id();
    $form_state->setRedirect("entity.{$content_entity_id}.canonical", [$content_entity_id => $entity->id()]);
  }
}