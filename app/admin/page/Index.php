<?php

namespace app\admin\page;

use app\core\Page;
use app\admin\component\Hello\Hello\Hello;

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
