<?php

namespace ntc\order\cart;

use app\core\component\Component;
use app\core\entity\Cart as CartEntity;
use app\core\http\Request;

class Cart extends Component
{

    public function render(Request $request)
    {
        $cart = CartEntity::where('user_id', $this->currentUser()->id())->first();
//        dump($cart);
//        dump($cart->products);
        return $this->display('ntc/order/cart', [
                'cart_id' => $cart->id,
                'products' => $cart->products
            ]
        );
    }

}
