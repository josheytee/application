<?php

namespace ntc\home\controller;

use app\core\controller\ControllerBase;
use app\core\entity\Cart;

/**
 * This is the default home page controller of the application
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class HomeController extends ControllerBase
{

    public function index()
    {
        dump(Cart::where('user_id',1)->first()->products()->first());
        return $this->renderCustom(__DIR__ . '/../../templates/home.tpl');
    }

}
