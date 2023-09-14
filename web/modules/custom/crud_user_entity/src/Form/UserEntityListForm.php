<?php

namespace Drupal\crud_user_entity\Form;

use Drupal\Core\Url;
use Drupal\Core\Render\RendererInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\{FormBase, FormStateInterface};
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserEntityListForm extends FormBase {

  public function __construct(
    protected ?EntityTypeManagerInterface $entity_type,
    protected ?RendererInterface $renderer
  ) { }

  public static function create(ContainerInterface $container): self {
    return new static(
      $container->get('entity_type.manager'),
      $container->get('renderer')
    );
  }
  public function getFormId(): string {
    return 'crud_user_entity_list_form_id';
  }

  public function buildForm(array $form, FormStateInterface $form_state): array {

    $row = [];
    $user_storage = $this->entity_type->getStorage('user');
    // returns an array of objects of type User
    $user_collection = $user_storage->loadMultiple(NULL);

    foreach ($user_collection as $key => $user) {

      // does not show the administrator in the list
      if ($user->getDisplayName() === 'admin') {
        continue;
      }

      $row[$key]['id'] = $user->id();
      $row[$key]['name'] = $user->getDisplayName();
      $row[$key]['mail'] = $user->getEmail();
      $row[$key]['created'] = $user->getCreatedTime();
      $row[$key]['changed'] = $user->getChangedTime();

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

    $form['users'] = [
      '#type' => 'table',
      '#header' => [
        'uid',
        'name',
        'mail',
        'created',
        'changed',
        'actions'
      ],
      '#rows' => $row,
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state): void { }
}

