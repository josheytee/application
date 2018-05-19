<?php

namespace ntc\order\controller;

use app\core\controller\ControllerBase;
use app\core\http\Request;
use ntc\shop\cart\Cart;

/**
 * This is the default home page controller of the application
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class OrderController extends ControllerBase
{

    public function index(Request $request, $step)
    {
        $components = '';
        $defaultSteps=['cart','sign in','address','shipping','payment'];
        $default = $this->moduleRepository->getRepository('ntc\order')->getCustom('default');
        if (is_array($shop->components)) {
            $default['components'] = $shop->components;
        }
        foreach ($default['components'] as $key) {
            $component = $this->componentManager->getComponent($key, 0);
            $components .= $component->renderComponent($request);
        }
        return $this->render('ntc/output', ['output' => $components]);
    }

}
