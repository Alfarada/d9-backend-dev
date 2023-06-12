<?php

namespace Drupal\section_entity\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

class SectionForm extends EntityForm {

  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);
    $section_entity = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $section_entity->label(),
      '#description' => $this->t("Label for the Section."),
      '#required' => TRUE,
    ];
    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $section_entity->id(),
      '#machine_name' => [
        'exists' => '\Drupal\section_entity\Entity\Section::load',
      ],
      '#disabled' => !$section_entity->isNew(),
    ];
    $form['urlPattern'] = [
      '#type' => 'textfield',
      '#title' => $this->t('URL pattern'),
      '#maxlength' => 255,
      '#default_value' => $section_entity->getUrlPattern(),
      '#description' => $this->t("URL pattern for the Section."),
      '#required' => TRUE,
    ];
    $form['color'] = [
      '#type' => 'color',
      '#title' => $this->t('Color'),
      '#default_value' => $section_entity->getColor(),
      '#description' => $this->t("Color for the Section."),
      '#required' => TRUE,
    ];
    return $form;
  }

  public function save(array $form, FormStateInterface $form_state) {
    $section_entity = $this->entity;
    $status = $section_entity->save();
    switch ($status) {
      case SAVED_NEW:
        $this->messenger()->addMessage($this->t('Created the %label Section.', [
          '%label' => $section_entity->label(),
        ]));
        break;
      default:
        $this->messenger()->addMessage($this->t('Saved the %label Section.', [
          '%label' => $section_entity->label(),
        ]));
    }
    $form_state->setRedirectUrl($section_entity->toUrl('collection'));
  }
}
