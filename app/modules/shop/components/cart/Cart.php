<?php

namespace ntc\shop\cart;

use app\core\component\Component;
use app\core\http\Request;

class Cart extends Component
{

   public function render(Request $request)
    {
        return $this->display('ntc/shop/cart');
    }

}
