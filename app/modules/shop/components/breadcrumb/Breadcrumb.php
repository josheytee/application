<?php

namespace ntc\shop\breadcrumb;

use app\core\component\Component;

class Breadcrumb extends Component
{

    public function render()
    {
        $this->setDefaultTemplate(__DIR__ . '/template/breadcrumb.tpl');
        return $this->display('ntc/shop/breadcrumb');
    }

}
