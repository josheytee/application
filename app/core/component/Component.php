<?php

namespace app\core\component;

use app\core\event\EventDispatcherInterface;
use app\core\service\KernelServiceInterface;
use app\core\service\KernelService;

/**
 * Description of Component
 *
 * @author Tobi
 */
abstract class Component {

    const TYPE_SYSTEM = 'SYSTEM';
    const TYPE_USER = 'USER';

    protected $dispatcher;
    protected $type;
    public $dir_name;
    public $name;
    public $schema;
    public $data;
    public $options;

    function __construct($schema = null, $data = null, $options = null) {
        $this->schema = $schema;
        $this->data = $data;
        $this->options = $options;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getTemplatePath($template) {
        $path = '';
        if (isset($this->pack_name)) {
            $path = _ADMIN_COMPONENT_DIR_ . $this->dir_name . DS . $this->pack_name . DS . $this->name . DS . $template;
        } else {
            $path = _ADMIN_COMPONENT_DIR_ . $this->dir_name . DS . $template;
        }
        return $path;
    }

    public function setErrorTemplate($template) {
        $this->getTemplatePath($template);
    }

    public function init() {

    }

    abstract public function render();

    public function postProcess() {
        if (!empty($_POST) /* || isset($_GET) */) {
            var_dump($_POST);
        }
    }

    public function get($service) {
        return KernelService::getService($service);
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
