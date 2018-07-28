<?php

namespace ntc\shop\hotline;

use app\core\component\Component;
use app\core\http\Request;

class Hotline extends Component
{

   public function render(Request $request)
    {
        return $this->display('ntc/shop/hotline');
    }

}
