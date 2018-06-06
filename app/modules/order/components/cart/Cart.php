<?php

namespace ntc\order\cart;

use app\core\component\Component;
use app\core\entity\Cart as CartEntity;
use app\core\http\Request;

class Cart extends Component
{

    private $user;

    public function init(Request $request)
    {
        $this->user = $this->currentUser();
    }

    public function getProductsFromCart()
    {
        $cart = CartEntity::where('user_id', $this->user->id())->first();
//        dump($cart->products)
        return ($cart->products);
    }

    public function render()
    {
        return $this->display('ntc/order/cart', [
                'products' => $this->getProductsFromCart()
            ]
        );
    }

}
