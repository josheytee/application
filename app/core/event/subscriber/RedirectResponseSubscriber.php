<?php

namespace app\core\event\subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class RedirectResponseSubscriber implements EventSubscriberInterface
{

    function __construct()
    {

    }

    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::RESPONSE => ['redirectResponse', 10]];
    }

    public function redirectResponse(FilterResponseEvent $event)
    {
        if ($event->getRequest()->attributes->has('_redirect')) {
//      var_dump($event->getRequest()->attributes->get('_redirect'));
            $rediret = $event->getRequest()->attributes->get('_redirect');
            $event->getRequest()->attributes->remove('_redirect');
            $event->setResponse(new RedirectResponse($rediret));
        }
    }

}
