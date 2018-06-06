<?php

namespace ntc\account\account;

use app\core\component\Component;
use app\core\http\Request;

class Account extends Component
{

    private $shop;

    public function init(Request $request)
    {
        $this->shop = $this->currentShop();
    }

    public function render()
    {
        return $this->display('ntc/account/account', [
                'user' => $this->currentUser(),
                'name' => $this->shop->name,
                'params' => ['url' => $this->shop->url],
                'route' => 'shop.index'
//                {route n='shop.index' p=$url|default:''}
            ]
        );
    }

}
