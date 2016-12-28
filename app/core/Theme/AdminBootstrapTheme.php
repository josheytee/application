<?php

namespace app\core\theme;

use app\core\theme\Theme;

/**
 * Description of BootstrapTemplate
 *
 * @author Tobi
 */
class AdminBootstrapTheme extends Theme {

    protected $name = "Bootstrap";

    public function __construct() {
        parent::__construct($this->name);
        $this->dir = _THEME_ADMIN_DIR_ . 'master/';
    }

}
