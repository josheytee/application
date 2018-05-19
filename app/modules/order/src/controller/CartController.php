<?php

namespace ntc\order\controller;

use app\core\controller\ControllerBase;
use app\core\http\Request;
use app\core\http\Response;
use ntc\shop\cart\Cart;

/**
 * This is the default home page controller of the application
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class CartController extends ControllerBase
{

    public function index(Request $request,$key)
    {
        $shop_components = '';
        $shop = Cart::where('url', $url)->first();
        $default = $this->moduleRepository->getRepository('ntc\shop')->getCustom('default');
        if (is_array($shop->components)) {
            $default['components'] = $shop->components;
        }
        foreach ($default['components'] as $key) {
            $component = $this->componentManager->getComponent($key, 0);
            $shop_components .= $component->renderComponent($request);
        }
        return $this->render('ntc/output', ['output' => $shop_components]);
    }

}
