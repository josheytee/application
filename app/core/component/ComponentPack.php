<?php

namespace app\core\component;

use app\core\component\Component;

/**
 *
 * @author Tobi
 */
abstract class ComponentPack extends Component {

    public $components;
    public $default_component;

    public function __construct($schema = null, $data = null, $options = null) {
        parent::__construct($schema, $data, $options);
    }

    public function addComponent(Component $component, $name = null) {
        if (isset($name)) {
            $this->components[$name] = $component;
        } else {
            $this->components[] = $component;
        }
    }

    public function removeComponent(Component $component) {

    }

    public function renderComponent($name = null) {
        if (isset($name)) {
            return $this->components[$name]->renderComponent();
        }
        return parent::renderComponent();
    }

    public function renderAll() {

    }

}
