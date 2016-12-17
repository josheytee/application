<?php

namespace app\core\component;

use app\core\event\EventDispatcherInterface;
use app\core\service\KernelServiceInterface;

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

    public function postProcess() {
        if (!empty($_POST) /* || isset($_GET) */) {
            var_dump($_POST);
        }
    }

    public function notify($dispatcher) {

    }

    public function notifyAll() {

    }

    public function render() {

    }

    public function renderComponent() {
        $this->postProcess();
        $this->render();
    }

}
