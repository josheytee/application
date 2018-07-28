<?php

namespace ntc\shop\slider;

use app\core\component\Component;
use app\core\http\Request;

class Slider extends Component
{

   public function render(Request $request)
    {
        return $this->display('ntc/shop/slider');
    }

}
 