<?php

namespace ntc\order\controller;

use app\core\component\ComponentManager;
use app\core\controller\ControllerBase;
use app\core\entity\Cart;
use app\core\entity\Product;
use app\core\http\Request;
use app\core\repository\ModuleRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * This is the default home page controller of the application
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class CartController extends ControllerBase
{
    /**
     * @var ComponentManager
     */
    private $componentManager;
    /**
     * @var ModuleRepository
     */
    private $moduleRepository;

    public function __construct(ModuleRepository $moduleRepository, ComponentManager $componentManager)
    {
        $this->componentManager = $componentManager;
        $this->moduleRepository = $moduleRepository;
    }

    public static function inject(ContainerInterface $container)
    {
        return new static($container->get('module.repository'), $container->get('component.manager'));
    }

    public function index(Request $request, $key)
    {
        $cart_components = '';
        $cart = Cart::where('key', $key)->first();
        $default = $this->moduleRepository->getRepository('ntc\order')->getCustom('default');

        if (is_array($cart->components)) {
            $default[] = $cart->components;
        }
        foreach ($default['cart.index'] as $key) {
            $component = $this->componentManager->getComponent($key, 0);
            $cart_components .= $component->renderComponent($request);
        }
        return $this->render('ntc/output', ['output' => $cart_components]);
    }

    /**
     * @param $shop_id
     * @param $product_id
     */
    public function ajaxAddToCart($shop_id, $product_id)
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

    public function ajaxEditQuantity($cart_id, $product_id, $quantity)
    {
        $cart = Cart::find($cart_id);
        $cart->products()->syncWithoutDetaching([$product_id => ['quantity' => $quantity]]);
        die();
    }
}
