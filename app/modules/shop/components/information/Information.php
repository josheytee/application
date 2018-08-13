<?php

namespace ntc\shop\information;

use app\core\component\Component;
use app\core\entity\Shop;
use app\core\http\Request;

class Information extends Component
{

    public function render(Request $request)
    {
        $shop = Shop::where('url', $request->shop_url)->first();
        return $this->display('ntc/shop/information', [
            'name' => $shop->name,
            'description' => $shop->description
        ]);
    }
}