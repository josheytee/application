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

    function __construct() {

    }

    public function addComponent(Component $component) {
        $this->components[] = $component;
    }

    public function removeComponent(Component $component) {

    }

    public function renderComponent(Component $component = null) {
        if (isset($component)) {
            return $component->renderComponent();
        }
        return parent::renderComponent();
    }

    public function renderAll() {

    }

}
