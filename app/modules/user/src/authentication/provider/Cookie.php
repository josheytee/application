<?php

namespace ntc\user\authentication\provider;

use app\core\account\{
    AccountInterface,
    AuthenticationProviderInterface,
    UserAccount
};
use app\core\http\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use app\core\Context;
use app\core\entity\User;

/**
 * Cookie based authentication provider.
 */
class Cookie implements AuthenticationProviderInterface {

    /**
     * Constructs a new cookie authentication provider.
     *
     */
    public function __construct() {

//        $this->sessionConfiguration = $session_configuration;
//        $this->connection = $connection;
    }

    /**
     * {@inheritdoc}
     */
    public function applies(Request $request) {
        return $request->hasSession();
//                && $this->sessionConfiguration->hasSession($request);
    }

    /**
     * {@inheritdoc}
     */
    public function authenticate(Request $request) {
//        dump($request);
        return $this->getUserFromSession($request->getSession());
    }

    /**
     * Returns the UserSession object for the given session.
     *
     * @param \Symfony\Component\HttpFoundation\Session\SessionInterface $session
     *   The session.
     *
     * @return AccountInterface|NULL
     *   The UserSession object for the current user, or NULL if this is an
     *   anonymous session.
     */
    protected function getUserFromSession(SessionInterface $session) {
        if ($uid = $session->get('logged')) {
            // @todo Load the User entity in SessionHandler so we don't need queries.

            $user = Context::getContext()->manager->find(User::class, $uid);
            return new UserAccount($user);
        }

        // This is an anonymous session.
        return NULL;
    }

}
