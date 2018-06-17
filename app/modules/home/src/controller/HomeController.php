<?php

namespace ntc\home\controller;

use app\core\controller\ControllerBase;
use app\core\entity\Cart;
use app\core\entity\Category;
use app\core\entity\Shop;

/**
 * This is the default home page controller of the application
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class HomeController extends ControllerBase
{

    public function index()
    {
        dump(Shop::find(1)->sections()->get());
//        dump(Category::find(1)->shops()->get());
        return $this->renderCustom(__DIR__ . '/../../templates/home.tpl');
    }

}
