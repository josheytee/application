<?php

namespace app\core\event\subscriber;

use app\core\routing\RouteMatchInterface;
use app\core\theme\block\BlockManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Description of ResponseNormalizerSubscriber
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class DefaultResponseHandlerSubscriber implements EventSubscriberInterface
{

    /**
     * @var RouteMatchInterface
     */
    private $routeMatch;

    /**
     * @var BlockManagerInterface
     */
    private $blockManager;

    public function __construct(BlockManagerInterface $blockManager,RouteMatchInterface $routeMatch)
    {

        $this->blockManager = $blockManager;
        $this->routeMatch = $routeMatch;
    }

    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::VIEW => ['controller',1]];
    }

    public function controller(GetResponseForControllerResultEvent $event)
    {
        $result = $event->getControllerResult();
        $request = $event->getRequest();
//        dump($this->routeMatch);
        $response = $this->blockManager->generateResponse($result,$request,$this->routeMatch);

        $event->setResponse($response);
    }

}
