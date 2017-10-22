<?php

namespace ntc\administrator\brand;

use app\core\component\Component;

class Brand extends Component
{

    private $shop;

    public function init()
    {
        $this->shop = $this->currentShop();
    }

    public function render()
    {
        return $this->display('ntc/administrator/brand', [
                'name' => $this->shop->getName(),
                'url' => ['url' => $this->shop->getUrl()],
                'route' => 'shop.index'
//                {route n='shop.index' p=$url|default:''}
            ]
        );
    }

}
