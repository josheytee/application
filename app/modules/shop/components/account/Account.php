<?php

namespace ntc\shop\account;

use app\core\component\Component;
use app\core\http\Request;

class Account extends Component
{

   public function render(Request $request)
    {
        return $this->display('ntc/shop/account');
    }

}
