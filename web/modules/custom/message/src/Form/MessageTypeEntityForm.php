<?php

namespace Drupal\message\Form;

use Drupal\field_ui\FieldUI;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\BundleEntityFormBase;

class MessageTypeEntityForm extends BundleEntityFormBase {

  public function form(array $form, FormStateInterface $form_state): array {
    $form = parent::form($form, $form_state);

    $entity_type = $this->entity;
    $content_entity_id = $entity_type->getEntityType()->getBundleOf();

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $entity_type->label(),
      '#description' => $this->t("Label for the %content_entity_id entity type (bundle).", ['%content_entity_id' => $content_entity_id]),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $entity_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\message\Entity\MessageTypeEntity::load',
      ],
      '#disabled' => !$entity_type->isNew(),
    ];

    return $this->protectBundleIdElement($form);
  }

  /**
   * {@inheritdoc}
   */
  protected function actions(array $form, FormStateInterface $form_state): array {
    $actions = parent::actions($form, $form_state);

    if (\Drupal::moduleHandler()->moduleExists('field_ui') && $this->getEntity()->isNew()) {
      $actions['save_continue'] = $actions['submit'];
      $actions['save_continue']['#value'] = $this->t('Save and manage fields');
      $actions['save_continue']['#submit'][] = [$this, 'redirectToFieldUi'];
    }

    return $actions;
  }

  /**
   * Form submission handler to redirect to Manage fields page of Field UI.
   *
   * @param array $form
   * @param FormStateInterface $form_state
   */
  public function redirectToFieldUi(array $form, FormStateInterface $form_state): void {
    $route_info = FieldUI::getOverviewRouteInfo($this->entity->getEntityType()->getBundleOf(), $this->entity->id());

    if ($form_state->getTriggeringElement()['#parents'][0] === 'save_continue' && $route_info) {
      $form_state->setRedirectUrl($route_info);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state): void {
    $entity_type = $this->entity;
    $status = $entity_type->save();
    $message_params = [
      '%label' => $entity_type->label(),
      '%content_entity_id' => $entity_type->getEntityType()->getBundleOf(),
    ];

    switch ($status) {
      case SAVED_NEW:
        $this->messenger()
          ->addStatus($this->t('Created the %label %content_entity_id entity type.', $message_params));
        break;

      default:
        $this->messenger()
          ->addStatus($this->t('Saved the %label %content_entity_id entity type.', $message_params));
    }

    $form_state->setRedirectUrl($entity_type->toUrl('collection'));
  }

}