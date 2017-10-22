<?php

namespace ntc\shop\account;

use app\core\component\Component;

class Account extends Component
{

    public function render()
    {
        return $this->display('ntc/shop/account');
    }

}
