<?php

namespace app\core\access;

use app\core\account\AccountInterface;

/**
 * Description of AccessResult
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class AccessResult implements AccessResultInterface
{

    /**
     * Creates an AccessResultInterface object with isNeutral() === TRUE.
     *
     * @return \app\Core\Access\AccessResult
     *   isNeutral() will be TRUE.
     */
    public static function neutral()
    {
        return new AccessResultNeutral();
    }

    /**
     * Creates an AccessResultInterface object with isAllowed() === TRUE.
     *
     * @return \app\Core\Access\AccessResult
     *   isAllowed() will be TRUE.
     */
    public static function allowed()
    {
        return new AccessResultAllowed();
    }

    /**
     * Creates an AccessResultInterface object with isForbidden() === TRUE.
     *
     * @return \app\Core\Access\AccessResult
     *   isForbidden() will be TRUE.
     */
    public static function forbidden()
    {
        return new AccessResultForbidden();
    }

    /**
     * Creates an allowed or neutral access result.
     *
     * @param bool $condition
     *   The condition to evaluate.
     *
     * @return \app\Core\Access\AccessResult
     *   If $condition is TRUE, isAllowed() will be TRUE, otherwise isNeutral()
     *   will be TRUE.
     */
    public static function allowedIf($condition)
    {
        return $condition ? static::allowed() : static::neutral();
    }

    /**
     * Creates a forbidden or neutral access result.
     *
     * @param bool $condition
     *   The condition to evaluate.
     *
     * @return \app\Core\Access\AccessResult
     *   If $condition is TRUE, isForbidden() will be TRUE, otherwise isNeutral()
     *   will be TRUE.
     */
    public static function forbiddenIf($condition)
    {
        return $condition ? static::forbidden() : static::neutral();
    }

    /**
     * Creates an allowed access result if the permission is present, neutral otherwise.
     *
     * Checks the permission and adds a 'user.permissions' cache context.
     *
     * @param \app\Core\Session\AccountInterface $account
     *   The account for which to check a permission.
     * @param string $permission
     *   The permission to check for.
     *
     * @return \app\Core\Access\AccessResult
     *   If the account has the permission, isAllowed() will be TRUE, otherwise
     *   isNeutral() will be TRUE.
     */
    public static function allowedIfHasPermission(AccountInterface $account, $permission)
    {
        return static::allowedIf($account->hasPermission($permission));
        //->addCacheContexts(['user.permissions']);
    }

    /**
     * Creates an allowed access result if the permissions are present, neutral otherwise.
     *
     * Checks the permission and adds a 'user.permissions' cache contexts.
     *
     * @param \app\Core\Session\AccountInterface $account
     *   The account for which to check permissions.
     * @param array $permissions
     *   The permissions to check.
     * @param string $conjunction
     *   (optional) 'AND' if all permissions are required, 'OR' in case just one.
     *   Defaults to 'AND'
     *
     * @return \app\Core\Access\AccessResult
     *   If the account has the permissions, isAllowed() will be TRUE, otherwise
     *   isNeutral() will be TRUE.
     */
    public static function allowedIfHasPermissions(AccountInterface $account, array $permissions, $conjunction = 'AND')
    {
        $access = FALSE;

        if ($conjunction == 'AND' && !empty($permissions)) {
            $access = TRUE;
            foreach ($permissions as $permission) {
                if (!$permission_access = $account->hasPermission($permission)) {
                    $access = FALSE;
                    break;
                }
            }
        } else {
            foreach ($permissions as $permission) {
                if ($permission_access = $account->hasPermission($permission)) {
                    $access = TRUE;
                    break;
                }
            }
        }

        return static::allowedIf($access);
        //->addCacheContexts(empty($permissions) ? [] : ['user.permissions']);
    }

    /**
     * {@inheritdoc}
     */
    public function andIf(AccessResultInterface $other)
    {
        // The other access result's cacheability metadata is merged if $merge_other
        // gets set to TRUE. It gets set to TRUE in one case: if the other access
        // result is used.
        $merge_other = FALSE;
        if ($this->isForbidden() || $other->isForbidden()) {
            $result = static::forbidden();
            if (!$this->isForbidden()) {
                $merge_other = TRUE;
            }
        } elseif ($this->isAllowed() && $other->isAllowed()) {
            $result = static::allowed();
            $merge_other = TRUE;
        } else {
            $result = static::neutral();
            if (!$this->isNeutral()) {
                $merge_other = TRUE;
            }
        }
//    $result->inheritCacheability($this);
//    if ($merge_other) {
//      $result->inheritCacheability($other);
//      // If this access result is not cacheable, then an AND with another access
//      // result must also not be cacheable, except if the other access result
//      // has isForbidden() === TRUE. isForbidden() access results are contagious
//      // in that they propagate regardless of the other value.
//      if ($this->getCacheMaxAge() === 0 && !$result->isForbidden()) {
//        $result->setCacheMaxAge(0);
//      }
//    }
        return $result;
    }

    public function isAllowed()
    {
        return FALSE;
    }

    public function isForbidden()
    {
        return FALSE;
    }

    public function isNeutral()
    {
        return FALSE;
    }

    public function orIf(AccessResultInterface $other)
    {

    }

}
