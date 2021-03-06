<?php

namespace Drupal\association;

use Drupal\association\Entity\MemberInterface;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Member entity.
 *
 * @see \Drupal\association\Entity\Member.
 */
class MemberAccessControlHandler extends EntityAccessControlHandler
{

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account)
  {
    /** @var MemberInterface $entity */
    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view member entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit member entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete member entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL)
  {
    return AccessResult::allowedIfHasPermission($account, 'add member entities');
  }

}
