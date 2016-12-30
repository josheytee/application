<?php

namespace app\page\admin;

use app\core\Page;

/**
 * Description of Product
 *
 * @author Tobi
 */
class Product extends Page {

    public function initPage() {
        parent::initPage();
        $this->registerComponent(new \app\component\defaultbootstrap\Register\Register());
        $this->setTheme(new \app\core\theme\AdminBootstrapTheme());
    }

}
