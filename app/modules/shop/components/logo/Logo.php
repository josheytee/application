<?php

namespace ntc\shop\logo;

use app\core\component\Component;
use app\core\http\Request;

class Logo extends Component
{

    private $shop;

    public function init(Request $request)
    {
        $this->shop = $this->currentShop();
    }

//    public function render()
//    {
//        return $this->display('ntc/administrator/brand', [
//                'name' => $this->shop->name,
//                'params' => ['url' => $this->shop->url],
//                'route' => 'shop.index'
////                {route n='shop.index' p=$url|default:''}
//            ]
//        );
//    }
   public function render(Request $request)
    {
        return $this->display('ntc/shop/logo', [
            'shop_name' => 'New Shop',
            'shop_description' => 'SHOP ANYWHERE'
        ]);
    }


}
