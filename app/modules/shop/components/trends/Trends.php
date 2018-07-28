<?php

namespace ntc\shop\trends;

use app\core\component\Component;
use app\core\http\Request;

class Trends extends Component
{

   public function render(Request $request)
    {
        return $this->display('ntc/shop/trends');
    }
}