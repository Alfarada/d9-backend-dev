<?php

namespace Drupal\ja_email_example\Form;

use Drupal\Core\Mail\MailManagerInterface;
use Egulias\EmailValidator\EmailValidator;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\Core\Form\{FormBase, FormStateInterface};
use Symfony\Component\DependencyInjection\ContainerInterface;

class EmailMessageForm extends FormBase {

  public function __construct(
    protected MailManagerInterface $mailManager,
    protected LanguageManagerInterface $languageManager,
    protected EmailValidator $emailValidator
  ) {}

  public static function create(ContainerInterface $container): self {
    return new static(
      $container->get('plugin.manager.mail'),
      $container->get('language_manager'),
      $container->get('email.validator'),
    );
  }

  /**
   * @inheritDoc
   */
  public function getFormId(): string {
    return 'ja_email_example';
  }

  /**
   * @inheritDoc
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $form['intro'] = [
      '#markup' => $this->t('Use this form to send a message to an e-mail address'),
    ];

    $form['message_to'] = [
      '#type' => 'email',
      '#title' => $this->t('E-mail address'),
      '#required' => TRUE,
    ];
    $form['message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Message'),
      '#required' => TRUE,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];
    return $form;
  }

  /**
   * @inheritDoc
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $form_values = $form_state->cleanValues()->getValues();

    $module = 'ja_email_example';
    $key = 'contact_message';

    // direccion o direcciones del correo electrónico al cual enviarás el mensaje
    // , las direcciones deben separarse por comas
    $to = $form_values['message_to'];
    // direccion de correo desde la que se envía el mensaje
//    $from = $this->config('system.site')->get('mail');

    $params = $form_values;
    $language_code = $this->languageManager->getDefaultLanguage()->getId();
    $send_now = TRUE;

    $result = $this->mailManager->mail(
      $module,
      $key,
      $to,
      $language_code,
      $params,
      NULL,
      $send_now
    );

//    dpm($result);

    if ($result['result']) {
      $this->messenger()->addMessage($this->t('Your message has been sent.'));
    } else {
      $this->messenger()->addMessage($this->t('There was a problem sending your message and it was not sent.'));
    }
  }
}