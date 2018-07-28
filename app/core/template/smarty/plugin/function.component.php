<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.component.php
 * Type:     function
 * Name:     component
 * Purpose:  dynamically calls a component by name and initializes it
 * with a given params
 * -------------------------------------------------------------
 */

use app\core\Context;

function smarty_function_component($params)
{
    $name = $params['n'];
    $param = $params['p'];
    $component = Context::componentManager()->getComponent($name, 0);
    return $component->renderWithParams($param);
}
