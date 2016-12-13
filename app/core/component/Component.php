<?php

namespace app\core\component;

use app\core\event\EventDispatcherInterface;

/**
 * Description of Component
 *
 * @author Tobi
 */
class Component {

    const TYPE_SYSTEM = 'SYSTEM';
    const TYPE_USER = 'USER';

    protected $dispatcher;
    protected $type;

    public function __construct(EventDispatcherInterface $dispatcher) {
        $this->dispatcher = $dispatcher;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function notify($dispatcher) {

    }

    public function notifyAll() {

    }

    public function render() {

    }

}
