<?php

namespace app\core\event\subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class HttpExceptionSubscriberBase implements EventSubscriberInterface
{


    /**
     * Specifies the priority of all listeners in this class.
     *
     * The default priority is 1, which is very low. To have listeners that have
     * a "first attempt" at handling exceptions return a higher priority.
     *
     * @return int
     *   The event priority of this subscriber.
     */
    protected static function getPriority()
    {
        return 0;
    }

    /**
     * Handles errors for this subscriber.
     *
     * @param \Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent $event
     *   The event to process.
     */
    public function onException(GetResponseForExceptionEvent $event)
    {
        dump($event);
    }

    /**
     * Registers the methods in this class that should be listeners.
     *
     * @return array
     *   An array of event listener definitions.
     */
    public static function getSubscribedEvents()
    {
//    [KernelEvents::EXCEPTION]= ['', static::getPriority()];
        return [KernelEvents::EXCEPTION => ['onException', 1]];
    }

}
