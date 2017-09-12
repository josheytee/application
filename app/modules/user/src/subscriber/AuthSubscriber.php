<?php

namespace ntc\user\subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use app\core\account\AuthenticationProviderInterface;
use app\core\account\AccountProxyInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail dot com>
 */
class AuthSubscriber implements EventSubscriberInterface {

    /**
     * @var \app\core\account\AuthenticationProviderInterface
     */
    private $authentication_provider;

    /**
     * @var AccountProxyInterface
     */
    private $account_proxy;

    public function __construct(AuthenticationProviderInterface $authentication_provider, AccountProxyInterface $account_proxy) {

        $this->account_proxy = $account_proxy;
        $this->authentication_provider = $authentication_provider;
    }

    public static function getSubscribedEvents(): array {
        return [KernelEvents::REQUEST => ['authorizeRequest', 31]];
    }

    public function authorizeRequest(GetResponseEvent $event) {
        if ($event->getRequestType() === HttpKernelInterface::MASTER_REQUEST) {
            $request = $event->getRequest();
            if ($this->authentication_provider->applies($request)) {
                $account = $this->authentication_provider->authenticate($request);
//                dump($account);
                if ($account) {
                    $this->account_proxy->setAccount($account);
                    return;
                }
            }
        }
    }

}
