<?php

namespace ntc\carrier\controller;

use app\core\controller\ControllerBase;

/**
 * This is the default home page controller of the application
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class CarrierController extends ControllerBase
{

    public function index()
    {
        return $this->renderCustom(__DIR__ . '/../../templates/home.tpl');
    }

    public function single($url)
    {
        echo $url;
        return $this->renderCustom(__DIR__ . '/../../templates/home.tpl');
    }

}
