<?php

namespace ntc\administrator\brand;

use app\core\component\Component;
use app\core\http\Request;

class Brand extends Component
{

    private $shop;

    public function init(Request $request)
    {
        $this->shop = $this->currentShop();
    }

    public function render(Request $request)
    {
        $this->init($request);
        return $this->display('ntc/administrator/brand', [
               'name' => $this->shop->name,
               'params' => ['shop_url' => $this->shop->url],
                'route' => 'shop.index'
//                {route n='shop.index' p=$url|default:''}
            ]
        );
    }

}
