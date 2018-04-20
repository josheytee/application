<?php

namespace app\core\account;

use app\core\http\Request;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail dot com>
 */
class AuthenticationManager implements AuthenticationProviderInterface
{

    /**
     * @var AuthenticationCollector
     */
    private $auth_collector;
    private $provider_ids;

    public function __construct(AuthenticationCollector $auth_collector)
    {
        $this->auth_collector = $auth_collector;
    }


    /**
     * Returns the id of the authentication provider for a request.
     *
     * @param Request $request
     *   The incoming request.
     *
     * @return string|NULL
     *   The id of the first authentication provider which applies to the request.
     *   If no application detects appropriate credentials, then NULL is returned.
     */
    protected function getProvider(Request $request)
    {
//        dump($this->auth_collector->getSortedProviders());
        foreach ($this->auth_collector->getSortedProviders() as $provider_id => $provider) {
            if ($provider->applies($request)) {
                return $provider_id;
            }
        }
    }

    public function authenticate(Request $request)
    {
        $provider_id = $this->getProvider($request);
        $provider = $this->auth_collector->getProvider($provider_id);

        if ($provider) {
            return $provider->authenticate($request);
        }

        return NULL;
    }

    public function applies(Request $request)
    {
        return (bool) $this->getProvider($request);
    }
}
