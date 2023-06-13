<?php

namespace Drupal\test_config_entity\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Foo Entity form.
 *
 * @property \Drupal\test_config_entity\FooEntityInterface $entity
 */
class FooEntityForm extends EntityForm {

  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);
    $foo_entity = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $foo_entity->label(),
      '#description' => $this->t("Label for Foo."),
      '#required' => TRUE,
    ];
    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $foo_entity->id(),
      '#machine_name' => [
        'exists' => '\Drupal\test_config_entity\Entity\FooEntity::load',
      ],
      '#disabled' => !$foo_entity->isNew(),
    ];
    $form['urlPattern'] = [
      '#type' => 'textfield',
      '#title' => $this->t('URL pattern'),
      '#maxlength' => 255,
      '#default_value' => $foo_entity->getUrlPattern(),
      '#description' => $this->t("URL pattern for Foo."),
      '#required' => TRUE,
    ];
    $form['color'] = [
      '#type' => 'color',
      '#title' => $this->t('Color'),
      '#default_value' => $foo_entity->getColor(),
      '#description' => $this->t("Color for Foo."),
      '#required' => TRUE,
    ];
    return $form;
  }

  public function save(array $form, FormStateInterface $form_state) {
    $foo_entity = $this->entity;
    $status = $foo_entity->save();
    switch ($status) {
      case SAVED_NEW:
        $this->messenger()->addMessage($this->t('Created the %label Foo.', [
          '%label' => $foo_entity->label(),
        ]));
        break;
      default:
        $this->messenger()->addMessage($this->t('Saved the %label Foo.', [
          '%label' => $foo_entity->label(),
        ]));
    }
    $form_state->setRedirectUrl($foo_entity->toUrl('collection'));
  }
}
