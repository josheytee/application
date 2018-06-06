<?php

namespace ntc\account\subscriber;

use app\core\account\AccountProxyInterface;
use app\core\account\AuthenticationManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail dot com>
 */
class AuthenticationSubscriber implements EventSubscriberInterface
{

    /**
     * @var AccountProxyInterface
     */
    private $accountProxy;
    private $authenticationManager;

    public function __construct(AuthenticationManager $authManager, AccountProxyInterface $accountProxy)
    {

        $this->accountProxy = $accountProxy;
        $this->authenticationManager = $authManager;
    }
    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::REQUEST => ['authenticateRequest', 30]];
    }

    public function authenticateRequest(GetResponseEvent $event)
    {
        if ($event->getRequestType() === HttpKernelInterface::MASTER_REQUEST) {
            $request = $event->getRequest();
            if ($this->authenticationManager->applies($request)) {
                $account = $this->authenticationManager->authenticate($request);
//                dump($account);
                if ($account) {
                    $this->accountProxy->setAccount($account);
                    return;
                }
            }
        }
    }

}
