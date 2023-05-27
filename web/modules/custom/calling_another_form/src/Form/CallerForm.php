<?php

namespace Drupal\calling_another_form\Form;

use Drupal;
use Drupal\Core\Database\Connection;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\forcontu_forms\Form\Simple;
use Egulias\EmailValidator\EmailValidator;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CallerForm extends FormBase {
  protected $database;
  protected $currentUser;
  protected $emailValidator;
  public function __construct(Connection $database, AccountInterface $current_user, EmailValidator $email_validator) {
    $this->database = $database;
    $this->currentUser = $current_user;
    $this->emailValidator = $email_validator;
  }

  public static function create(ContainerInterface $container) {
    return new static($container->get('database'), $container->get('current_user'), $container->get('email.validator'));
  }

  function getFormId() {
    return 'simple';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $moduleHandler = Drupal::service('module_handler');

    if ($moduleHandler->moduleExists('forcontu_forms')) {
      $form = Drupal::formBuilder()
        ->getForm('Drupal\forcontu_forms\Form\Simple');
      return $form;
    }

    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('The title must be at least 5 characters long.'),
      '#required' => TRUE,
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $inputs = $form_state->getUserInput();
    $values['title'] = $inputs['title'];
    $values['color'] = $inputs['color'];
    $values['username'] = $inputs['username'];
    $values['user_email'] = $inputs['user_email'];

    Drupal::formBuilder()
      ->submitForm('Drupal\forcontu_forms\Form\Simple', $form_state);
  }

}
