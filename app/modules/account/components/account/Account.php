<?php

namespace ntc\account\account;

use app\core\component\Component;
use app\core\http\Request;

class Account extends Component
{

    public function render(Request $request)
    {
        return $this->display('ntc/account/account', [
                'user' => $this->currentUser(),
                'name' => $this->currentShop()->name,
                'params' => ['url' => $this->shop->url],
                'route' => 'shop.index'
//                {route n='shop.index' p=$url|default:''}
            ]
        );
    }

}
