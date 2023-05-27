<?php

namespace Drupal\forcontu_forms\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Implements the Simple form controller.
 */
class Simple extends FormBase {
  /**
   * The Simple database.
   *
   * @var database
   */
  protected $database;

  /**
   * The Simple current user.
   *
   * @var string
   */
  protected $currentUser;

  /**
   * The Simple email validator.
   *
   * @var object
   */
  protected $emailValidator;

  /**
   *
   * Alternative services injection.
   *
   * Public function __construct(Connection $database,
   * AccountInterface $current_user, EmailValidator $email_validator)
   * {
   * $this->database    = $database;
   * $this->currentUser = $current_user;
   * $this->emailValidator = $email_validator;
   * }.
   * Public static function create(ContainerInterface $container)
   * {
   * return new static(
   * $container->get('database'),
   * $container->get('current_user'),
   * $container->get('email.validator')
   * );
   * }.
   * Public function __construct($form) {
   * $this->simpleForm = $form;
   * }
   */
  public static function create(ContainerInterface $container) {
    $instance = parent::create($container);
    $instance->database = $container->get('database');
    $instance->currentUser = $container->get('current_user');
    $instance->emailValidator = $container->get('email.validator');
    return $instance;
  }

  /**
   * {@inheritDoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('The title must be at least 5 characters long.'),
      '#required' => TRUE,
    ];

    $form['color'] = [
      '#type' => 'select',
      '#title' => $this->t('Color'),
      '#options' => [
        0 => $this->t('Black'),
        1 => $this->t('Red'),
        2 => $this->t('Blue'),
        3 => $this->t('Green'),
        4 => $this->t('Orange'),
      ],
      '#default_value' => 2,
      '#description' => $this->t('Choose a color'),
    ];

    $form['username'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username'),
      '#description' => $this->t('Your username'),
      '#default_value' => $this->currentUser()->getAccountName(),
      '#required' => TRUE,
    ];

    $form['user_email'] = [
      '#type' => 'email',
      '#title' => $this->t('User email'),
      '#description' => $this->t('Your email.'),
      '#required' => TRUE,
      '#attributes' => ['class' => ['highlighted', 'forcontu']],
    ];

    $form['comment'] = [
      '#markup' => $this->t('Item elements <strong> to add HTML into a Form.'),
    ];

    $form['submit'] = [
      '#type'  => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritDoc}
   */
  public function getSimpleForm() {
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('The title must be at least 5 characters long.'),
      '#required' => TRUE,
    ];

    $form['color'] = [
      '#type' => 'select',
      '#title' => $this->t('Color'),
      '#options' => [
        0 => $this->t('Black'),
        1 => $this->t('Red'),
        2 => $this->t('Blue'),
        3 => $this->t('Green'),
        4 => $this->t('Orange'),
      ],
      '#default_value' => 2,
      '#description' => $this->t('Choose a color'),
    ];

    $form['username'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username'),
      '#description' => $this->t('Your username'),
      '#default_value' => $this->currentUser()->getAccountName(),
      '#required' => TRUE,
    ];

    $form['user_email'] = [
      '#type' => 'email',
      '#title' => $this->t('User email'),
      '#description' => $this->t('Your email.'),
      '#required' => TRUE,
      '#attributes' => ['class' => ['highlighted', 'forcontu']],
    ];

    $form['comment'] = [
      '#markup' => $this->t('Item elements <strong> to add HTML into a Form.'),
    ];

    $form['submit'] = [
      '#type'  => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * Get form id.
   */
  public function getFormId() {
    return 'forcontu_pages_simple';
  }

  /**
   * {@inheritDoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $title = $form_state->getValue('title');
    $email = $form_state->getValue('user_email');

    if (!$this->emailValidator->isValid($email)) {
      $form_state->setErrorByName(
          'user_email',
          $this->t(
              '%email is not a valid email adress.',
              ['%email' => $email]
          )
        );
    }

    if (strlen($title) < 5) {
      // Set an error for the form element with a key of "title".
      $form_state->setErrorByName('title', $this->t('The tittle must be at least 5 characters long.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $title = $form_state->getValue('title');
    $color = $form_state->getValue('color');
    $username = $form_state->getValue('username');
    $user_email = $form_state->getValue('user_email');

    $this->database->insert('forcontu_forms_simple')
      ->fields([
        'title' => $title,
        'color' => $color,
        'username' => $username,
        'email' => $user_email,
        'uid' => $this->currentUser()->id(),
        'ip' => \Drupal::request()->getClientIP(),
        'timestamp' => REQUEST_TIME,
      ])
      ->execute();

    $this->messenger()
      ->addMessage($this->t('The form has been submitted correctly'));
    $this->logger('forcontu_forms')
      ->notice(
            'New Simple Form entry from user %username inserted: %title.',
            [
              '%username' => $username,
              '%title' => $title,
            ]
        );
    $form_state->setRedirect('forcontu_pages.simple');
  }

}
