<?php

namespace app\core\event\subscriber;

use Symfony\Component\HttpKernel\EventListener\SessionListener;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of SessionSubscriber
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class SessionHandlerSubscriber extends SessionListener {

  private $container;

  public function __construct(ContainerInterface $container) {
    $this->container = $container;
  }

  protected function getSession() {
    if (!$this->container->has('session')) {
      return;
    }

    return $this->container->get('session');
  }

}
