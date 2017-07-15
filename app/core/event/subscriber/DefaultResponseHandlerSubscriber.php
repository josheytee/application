<?php

namespace app\core\event\subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use app\core\view\block\BlockManager;
use app\core\routing\RouteMatchInterface;

/**
 * Description of ResponseNormalizerSubscriber
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class DefaultResponseHandlerSubscriber implements EventSubscriberInterface {

  /**
   * @var app\core\routing\RouteMatchInterface
   */
  private $route_match;

  /**
   * @var BlockManager
   */
  private $block;

  public function __construct(BlockManager $block, RouteMatchInterface $route_match) {

    $this->block = $block;
    $this->route_match = $route_match;
  }

  public static function getSubscribedEvents(): array {
    return [KernelEvents::VIEW => ['controller', 1]];
  }

  public function controller(GetResponseForControllerResultEvent $event) {
    $result = $event->getControllerResult();
    $request = $event->getRequest();
    dump($this->route_match);
    $response = $this->block->generateResponse($result, $request, $this->route_match);

    $event->setResponse($response);
  }

}
