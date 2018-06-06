<?php

namespace ntc\home\controller;

use app\core\controller\ControllerBase;

/**
 * This is the default home page controller of the application
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class PaymentController extends ControllerBase
{

    public function index()
    {
        return $this->renderCustom(__DIR__ . '/../../templates/home.tpl');
    }

}
