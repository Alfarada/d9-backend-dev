<?php

namespace Drupal\advertiser_entity\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\user\UserInterface;

/**
 * Defines the advertiser entity.
 *
 * @ingroup advertiser
 *
 * @ContentEntityType(
 *   id = "content_advertiser_entity",
 *   label = @Translation("Advertiser Content Entity"),
 *   handlers = {
 *      "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *      "list_builder" = "Drupal\advertiser_entity\Entity\Controller\AdvertiserListBuilder",
 *      "form" = {
 *        "default" = "Drupal\advertiser_entity\Form\AdvertiserForm",
 *        "delete" = "Drupal\advertiser_entity\Form\AdvertiserDeleteForm",
 *     },
 *     "access" = "Drupal\advertiser_entity\AdvertiserAccessControlHandler",
 *   },
 *   list_cache_contexts = { "user" },
 *   base_table = "advertiser_table",
 *   admin_permission = "administer advertiser entity",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *      "canonical" = "/content_advertiser_entity/{content_advertiser_entity}",
 *     "edit-form" = "/content_advertiser_entity/{content_advertiser_entity}/edit",
 *     "delete_form" = "/advertiser/{content_advertiser_entity}/delete",
 *     "collection" = "/content_advertiser_entity/list"
 *   },
 *   field_ui_base_route = "advertiser_entity.advertiser_settings",
 * )
 */

// class Advertiser extends ContentEntityBase implements ContentEntityInterface
// {
//     public static function baseFieldDefinitions(EntityTypeInterface $entity_type)
//     {

//         // Standard field, used as unique if primary index.
//         $fields['id'] = BaseFieldDefinition::create('integer')
//             ->setLabel(t('ID'))
//             ->setDescription(t('The ID of the Advertiser entity.'))
//             ->setReadOnly(TRUE);

//         // Standard field, unique outside of the scope of the current project.
//         $fields['uuid'] = BaseFieldDefinition::create('uuid')
//             ->setLabel(t('UUID'))
//             ->setDescription(t('The UUID of the Advertiser entity.'))
//             ->setReadOnly(TRUE);

//         return $fields;
//     }
// }


class Advertiser extends ContentEntityBase implements ContentEntityInterface
{
    use EntityChangedTrait;

    /**
     * {@inheritdoc}
     *
     * When a new entity instance is added, set the user_id entity reference to
     * the current user as the creator of the instance.
     */

    public static function preCreate(EntityStorageInterface $storage_controller, array &$values)
    {
        parent::preCreate($storage_controller, $values);
        $values += [
            'user_id' => \Drupal::currentUser()->id(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner()
    {
        return $this->get('user_id')->entity;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwnerId()
    {
        return $this->get('user_id')->target_id;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwnerId($uid)
    {
        $this->set('user_id', $uid);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(UserInterface $account)
    {
        $this->set('user_id', $account->id());
        return $this;
    }



    public static function baseFieldDefinitions(EntityTypeInterface $entity_type)
    {
        $fields['id'] = BaseFieldDefinition::create('integer')
            ->setLabel(t('ID'))
            ->setDescription(t('The ID of the Advertiser Content entity.'))
            ->setReadOnly(TRUE);

        $fields['uuid'] = BaseFieldDefinition::create('uuid')
            ->setLabel(t('UUID'))
            ->setDescription(t('The UUID of te Advertiser entity.'))
            ->setReadOnly(TRUE);

        $fields['name'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Name'))
            ->setDescription(t('The name of the Advertiser Content entity.'))
            ->setSettings([
                'max_length' => 255,
                'text_processing' => 0
            ])->setDefaultValue(NULL)
            ->setDisplayOptions('view', [
                'label' => 'above',
                'type' => 'string',
                'weight' => -6
            ])
            ->setDisplayOptions('form', [
                'type' => 'string_textfield',
                'weight' => -6,
            ])
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);

        $fields['first_name'] = BaseFieldDefinition::create('string')
            ->setLabel(t('First Name'))
            ->setDescription(t('The first name of the Advertiser entity.'))
            ->setSettings([
                'max_length' => 255,
                'text_processing' => 0,
            ])
            ->setDefaultValue(NULL)
            ->setDisplayOptions('view', [
                'label' => 'above',
                'type' => 'string',
                'weight' => -5,
            ])->setDisplayOptions('form', [
                'type' => 'string_textfield',
                'weight' => -5,
            ])
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);

        $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
            ->setLabel(t('User Name'))
            ->setDescription(t('The Name of the associated user.'))
            ->setSetting('target_type', 'user')
            ->setSetting('handler', 'default') // ?
            ->setDisplayOptions('view', [
                'label' => 'above',
                'type' => 'author',
                'weigth' => -3
            ])
            ->setDisplayOptions('form', [
                'type' => 'entity_reference_autocomplete',
                'settings' => [
                    'match_operator' => 'CONTAINS',
                    'match_limit' => 10,
                    'size' => 60,
                    'placeholder' => ''
                ],
                'weight' => -3
            ])
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);

        $fields['role'] = BaseFieldDefinition::create('list_string')
            ->setLabel(t('Role'))
            ->setDescription(t('The role of the advertiser content entity.'))
            ->setSettings([
                'allowed_values' => [
                    'administrator' => 'administrator',
                    'user' => 'user',
                ],
            ])
            // Set the default value of this field to 'user'.
            ->setDefaultValue('user')
            ->setDisplayOptions('view', [
                'label' => 'above',
                'type' => 'string',
                'weight' => -2,
            ])
            ->setDisplayOptions('form', [
                'type' => 'options_select',
                'weight' => -2,
            ])
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);

        $fields['langcode'] = BaseFieldDefinition::create('language')
            ->setLabel(t('Language code'))
            ->setDescription(t('The language code of ContentEntityExample entity.'));

        $fields['created'] = BaseFieldDefinition::create('created')
            ->setLabel(t('Created'))
            ->setDescription(t('The time that the entity was created.'));

        $fields['changed'] = BaseFieldDefinition::create('changed')
            ->setLabel(t('Changed'))
            ->setDescription(t('The time that the entity was last edited.'));

        return $fields;
    }
}
