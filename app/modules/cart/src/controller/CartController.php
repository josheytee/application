<?php

namespace ntc\cart\controller;

use app\core\controller\ControllerBase;
use app\core\http\Response;

/**
 * This is the default home page controller of the application
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class CartController extends ControllerBase
{

    public function index()
    {
        return new Response('njixs');
    }

}
