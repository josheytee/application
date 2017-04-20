<?php

namespace app\core\theme;

use app\core\theme\Theme;

/**
 * Description of BootstrapTemplate
 *
 * @author Tobi
 */
class AdminBootstrapTheme extends Theme {

    protected $name = "bootstrap";

    public function __construct() {
        parent::__construct($this->name);
        $this->dir = _ADMIN_THEME_DIR_ . 'master/';
//        var_dump($this->getThemeDir());
    }

}
