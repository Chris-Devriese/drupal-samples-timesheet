<?php

namespace Drupal\timesheet;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining an Entry entity.
 *
 *
 * @ingroup timesheet
 */
interface EntryInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
