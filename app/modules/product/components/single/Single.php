<?php

namespace ntc\product\single;

use app\core\component\Component;
use app\core\http\Request;

class Single extends Component
{

   public function render(Request $request)
    {
        return $this->display('ntc/product/single');
    }

}