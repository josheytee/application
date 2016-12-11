<?php

namespace app\core\template;

use app\core\template\Template;

/**
 * Description of BootstrapTemplate
 *
 * @author Tobi
 */
class BootstrapTemplate extends Template {

    protected $name = "Bootstrap";

    public function __construct() {
        parent::__construct($this->name);
    }

}
