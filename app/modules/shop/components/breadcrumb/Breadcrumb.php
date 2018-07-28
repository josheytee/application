<?php

namespace ntc\shop\breadcrumb;

use app\core\component\Component;
use app\core\http\Request;

class Breadcrumb extends Component
{

   public function render(Request $request)
    {
        $this->setDefaultTemplate(__DIR__ . '/template/breadcrumb.tpl');
        return $this->display('ntc/shop/breadcrumb');
    }

}
