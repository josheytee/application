<?php

namespace ntc\user\topnav;

use app\core\component\Component;
use app\core\http\Request;

class Topnav extends Component
{

    private $shop;

    public function init(Request $request)
    {
        $this->shop = $this->currentShop();
    }

    public function render()
    {
        return $this->display('ntc/user/topnav', [
                'user' => $this->currentUser(),
                'name' => $this->shop->name,
                'params' => ['url' => $this->shop->url],
                'route' => 'shop.index'
//                {route n='shop.index' p=$url|default:''}
            ]
        );
    }

}
