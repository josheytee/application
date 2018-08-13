<?php

namespace ntc\section\card;

use app\core\component\Component;
use app\core\entity\Section;
use app\core\entity\Shop;
use app\core\http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Card extends Component
{
    public function render(Request $request)
    {
        $shop = Shop::where('url', $request->get('shop_url', 'ntc'))->first();
        return $this->display('ntc/section/card', [

            'sections' => $shop->sections,
            'shop_url' => $request->get('shop_url', 'ntc')
        ]);
    }

}