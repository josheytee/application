<?php

namespace app\front\page;

use app\core\Page;
use app\front\component\Hello\Hello\Hello;

/**
 * Description of Index
 *
 * @author Tobi
 */
class Index extends Page {

    public function initPage() {
        parent::initPage();
        $this->registerComponent(new Hello());
        $this->setTheme(new \app\core\theme\AdminBootstrapTheme());
    }

}
