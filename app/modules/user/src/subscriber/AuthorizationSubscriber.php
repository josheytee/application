<?php

namespace ntc\user\subscriber;

use app\core\access\AccessChecker;
use app\core\account\AccountProxyInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail dot com>
 */
class AuthorizationSubscriber implements EventSubscriberInterface
{

    /**
     * @var AccountProxyInterface
     */
    private $accountProxy;
    /**
     * @var AccessChecker
     */
    private $accessChecker;

    public function __construct(AccessChecker $accessChecker, AccountProxyInterface $accountProxy)
    {
        $this->accountProxy = $accountProxy;
        $this->accessChecker = $accessChecker;
    }

    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::RESPONSE => ['authorizeResponse', 31]];
    }

    public function authorizeResponse(FilterResponseEvent $event)
    {
        if ($event->getRequestType() === HttpKernelInterface::MASTER_REQUEST) {
//            dump($this->accountProxy);
            $request = $event->getRequest();
            $result = $this->accessChecker->checkRequest($request, $this->accountProxy, TRUE);
//            dump($result);
            if (!$result->isAllowed()) {
                throw new AccessDeniedHttpException();
            }
        }
    }

}
