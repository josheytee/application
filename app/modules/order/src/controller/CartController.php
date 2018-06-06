<?php

namespace ntc\order\controller;

use app\core\controller\ControllerBase;
use app\core\entity\Cart;
use app\core\entity\Product;
use app\core\http\Request;

/**
 * This is the default home page controller of the application
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class CartController extends ControllerBase
{

    public function index(Request $request, $key)
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

    /**
     * @param $shop_id
     * @param $product_id
     */
    public function addToCart($shop_id, $product_id)
    {
        $product = Product::find($product_id);
        $message = 'product successfully added to your shopping cart';
        $user = $this->currentUser();
        if ($user->isAuthenticated()) {
            $cart = Cart::where('user_id', $user->id())
                ->where('shop_id', $shop_id)->first();
            if (isset($cart)) {
                $cart->products()->attach($product);
                $cart->save();
                echo json_encode([
                    'massage' => $message,
                    'product' => $product,
                ]);
                die;
            } else {
                $cart = Cart::create([
                    'user_id' => $user->id(),
                    'shop_id' => $shop_id,
                    'key' => uniqid()
                ]);
                $cart->products()->associate($product);
                $cart->save();
                echo json_encode([
                    'massage' => $message,
                    'product' => $product,
                ]);
                die;
            }
        } else {
            echo json_encode([
                'massage' => 'please sign in to add product to your cart',
                'product' => null,
            ]);
            die;
        }
    }
}
