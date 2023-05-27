<?php

namespace Drupal\advertiser_entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

interface AdvertiserInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface
{

}
