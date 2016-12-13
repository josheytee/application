<?php

namespace app\component\Hello;

use app\core\component\Component;

/**
 * Description of Hello
 *
 * @author Tobi
 */
class Hello extends Component {

    public function __construct(\app\core\event\EventDispatcherInterface $dispatcher) {
        parent::__construct($dispatcher);
    }

    public function render() {
        parent::render();
        return "<div>first hello component</div>";
    }

}
