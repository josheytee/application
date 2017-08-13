<?php

namespace app\core\event\subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class RedirectResponseSubscriber implements EventSubscriberInterface {

  function __construct() {

  }

  public function redirectResponse(FilterResponseEvent $event) {
    if ($event->getRequest()->attributes->has('_redirect')) {
//      var_dump($event->getRequest()->attributes->get('_redirect'));
      $rediret = $event->getRequest()->attributes->get('_redirect');
      $event->getRequest()->attributes->remove('_redirect');
      $event->setResponse(new \Symfony\Component\HttpFoundation\RedirectResponse($rediret));
    }
  }

  public static function getSubscribedEvents(): array {
    return [KernelEvents::RESPONSE => ['redirectResponse', 10]];
  }

}
