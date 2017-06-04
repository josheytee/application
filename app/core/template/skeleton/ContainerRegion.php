<?php

namespace app\core\template\skeleton;

use app\core\template\skeleton\Region;

/**
 * Description of ContainerRegion
 *
 */
class ContainerRegion extends Region {

    public function __construct($name, $content) {
        parent::__construct($name);
        $this->content = $content;
    }

    function getContent() {
        return $this->content;
    }

    function setContent($content) {
        $this->content = $content;
        return $this;
    }

}
