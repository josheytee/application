<?php

namespace ntc\administrator\event\subscriber;

use app\core\routing\AdminContext;
use app\core\routing\RouteMatchInterface;
use app\core\view\block\BlockManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Description of AdminResponseHandlerSubscriber
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class AdminResponseHandlerSubscriber implements EventSubscriberInterface
{

    /**
     * @var BlockManagerInterface
     */
    private $block;

    /**
     * @var RouteMatchInterface
     */
    private $route_match;

    /**
     * @var AdminContext
     */
    private $context;

    public function __construct(AdminContext $context, BlockManagerInterface $block, RouteMatchInterface $route_match)
    {

        $this->context = $context;
        $this->route_match = $route_match;
        $this->block = $block;
    }

    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::VIEW => ['onViewEvent', 2]];
    }

    public function onViewEvent(GetResponseForControllerResultEvent $event)
    {
        if (!$this->context->isAdminRoute()) {
            return;
        }
//    dump($this->route_match);
        $result = $event->getControllerResult();
        $request = $event->getRequest();
        $response = $this->block->generateResponse($result, $request, $this->route_match);
        $event->setResponse($response);
    }

}
