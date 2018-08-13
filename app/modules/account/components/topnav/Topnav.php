<?php

namespace ntc\account\topnav;

use app\core\component\Component;
use app\core\http\Request;

class Topnav extends Component
{

    public function render(Request $request)
    {
        return $this->display('ntc/account/topnav', [
                'user' => $this->currentUser(),
                'name' => $this->currentShop()->name,
                'params' => ['url' => $this->currentShop()->url],
                'route' => 'shop.index'
//                {route n='shop.index' p=$url|default:''}
            ]
        );
    }

}
