<?php

namespace app\core;

use app\core\event\EventDispatcherInterface;

/**
 * Description of Component
 *
 * @author Tobi
 */
class Component {

    protected $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher) {
        $this->dispatcher = $dispatcher;
    }

    public function notify($dispatcher) {

    }

    public function notifyAll() {

    }

    public function render() {
        echo "hello render";
    }

}
