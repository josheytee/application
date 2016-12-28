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
    public $dir_name;
    public $name;
    public $pack_name;

    public function __construct(EventDispatcherInterface $dispatcher = null) {
        $this->dispatcher = $dispatcher;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getTemplatePath($template) {
        $path = '';
        if (isset($this->pack_name)) {
            $path = _COMPONENT_DIR_ . $this->dir_name . '/' . $this->pack_name . '/' . $this->name . '/' . $template;
        } else {
            $path = _COMPONENT_DIR_ . $this->dir_name . \DIRECTORY_SEPARATOR . $this->name . \DIRECTORY_SEPARATOR . $template;
        }
        return $path;
    }

    public function init() {

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

    public function renderComponent() {
        $this->init();
        $this->getTemplatePath("");
        $this->postProcess();
        return $this->render();
    }

}
