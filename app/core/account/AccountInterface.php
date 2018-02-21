<?php

namespace app\core\account;

/**
 * Defines an account interface which represents the current user.
 *
 * Defines an object that has a user id, roles and can have session data. The
 * interface is implemented both by the global session and the user entity.
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail dot com>
 *
 */
interface AccountInterface
{

    /**
     * Role ID for anonymous users.
     */
    const ANONYMOUS_ROLE = 'anonymous';

    /**
     * Role ID for authenticated users.
     */
    const AUTHENTICATED_ROLE = 'authenticated';

    /**
     * Returns the user ID or 0 for anonymous.
     *
     * @return int
     *   The user ID.
     */
    public function id();

    /**
     * Returns a list of roles.
     *
     * @param bool $exclude_locked_roles
     *   (optional) If TRUE, locked roles (anonymous/authenticated) are not returned.
     *
     * @return array
     *   List of role IDs.
     */
    public function getRoles($exclude_locked_roles = FALSE);

    /**
     * Checks whether a user has a certain permission.
     *
     * @param string $permission
     *   The permission string to check.
     *
     * @return bool
     *   TRUE if the user has the permission, FALSE otherwise.
     */
    public function hasPermissions($permission);
    public function getPermissions();

    /**
     * Returns TRUE if the account is authenticated.
     *
     * @return bool
     *   TRUE if the account is authenticated.
     */
    public function isAuthenticated();

    /**
     * Returns TRUE if the account is anonymous.
     *
     * @return bool
     *   TRUE if the account is anonymous.
     */
    public function isAnonymous();

    /**
     * @return \app\core\entity_doctrine\Shop
     */
    public function getCurrentShop();

    /**
     * Returns the unaltered login name of this account.
     *
     * @return string
     *   An unsanitized plain-text string with the name of this account that is
     *   used to log in. Only display this name to admins and to the user who owns
     *   this account, and only in the context of the name used to login. For
     *   any other display purposes, use
     *
     */
    public function getUsername();

    /**
     * Returns the unaltered login name of this account.
     *
     * @return string
     *   An unsanitized plain-text string with the name of this account that is
     *   used to log in. Only display this name to admins and to the user who owns
     *   this account, and only in the context of the name used to login. For
     *   any other display purposes, use
     */
    public function getAccountName();

    /**
     * Returns the email address of this account.
     *
     * @return string
     *   The email address.
     */
    public function getEmail();

    /**
     * The timestamp when the account last accessed the site.
     *
     * A value of 0 means the user has never accessed the site.
     *
     * @return int
     *   Timestamp of the last access.
     */
    public function getLastAccessedTime();

    public function getPicture();
}
