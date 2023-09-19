<?php

namespace Drupal\crud_user_entity\Form;

use Drupal\Core\Url;
use Drupal\Core\Render\RendererInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Form\{FormBase, FormStateInterface};
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\{EntityInterface, EntityTypeManagerInterface};

class UserEntityListForm extends FormBase {

  private array $header = [
    'uid',
    'name',
    'mail',
    'created',
    'changed',
    'actions',
  ];

  public function __construct(
    protected ?EntityTypeManagerInterface $entity_type,
    protected ?AccountProxyInterface $current_user,
    protected ?RendererInterface $renderer
  ) {}

  public static function create(ContainerInterface $container): self {
    return new static(
      $container->get('entity_type.manager'),
      $container->get('current_user'),
      $container->get('renderer')
    );
  }

  public function getFormId(): string {
    return 'crud_user_entity_list_form_id';
  }

  public function getDefaultFields(EntityInterface $user): array {
    return [
      'id' => $user->id(),
      'name' => $user->getDisplayName(),
      'mail' => $user->getEmail(),
      'created' => $user->getCreatedTime(),
      'changed' => $user->getChangedTime()
    ];
  }
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $row = [];
    $user_storage = $this->entity_type->getStorage('user');
    $user_collection = $user_storage->loadMultiple(NULL);
    // gets the current user to check their roles
    $user_current = $user_storage->load($this->current_user->id());

    if ($user_current->hasRole('content_editor') || $user_current->hasRole('manager')) {
      // remove the "actions" field from the table header
      array_pop($this->header);

      foreach ($user_collection as $key => $user) {
        // does not show the administrator in the list
        if ($user->getDisplayName() === 'admin') {
          continue;
        }
        $row[$key] = $this->getDefaultFields($user);
      }
    } elseif ($user_current->hasRole('administrator')) {
      foreach ($user_collection as $key => $user) {
        // does not show the administrator in the list
        if ($user->getDisplayName() === 'admin') {
          continue;
        }

        $row[$key] = $this->getDefaultFields($user);

        $dropbutton = [
          '#type' => 'dropbutton',
          '#dropbutton_type' => 'small',
          '#links' => [
            'view_controller' => [
              'title' => $this->t('view'),
              'url' => Url::fromRoute('crud_user_entity.view', ['user' => $user->id()]),
            ],
            'edit_form' => [
              'title' => $this->t('edit'),
              'url' => Url::fromRoute('crud_user_entity.edit', ['user' => $user->id()]),
            ],
            'delete_form' => [
              'title' => $this->t('delete'),
              'url' => Url::fromRoute('crud_user_entity.delete', ['user' => $user->id()]),
            ],
          ],
        ];
        $row[$key]['dropbutton'] = $this->renderer->render($dropbutton);
      }
    }

    $form['users'] = [
      '#type' => 'table',
      '#header' => $this->header,
      '#rows' => $row,
    ];

    return $form;
  }
  public function submitForm(array &$form, FormStateInterface $form_state): void {}

}

