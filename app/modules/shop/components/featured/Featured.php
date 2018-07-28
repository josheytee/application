<?php

namespace ntc\shop\featured;


use app\core\component\Component;
use app\core\http\Request;

class Featured extends Component
{

   public function render(Request $request)
    {
        return $this->display('ntc/shop/featured');
    }
}