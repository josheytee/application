<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.component.php
 * Type:     function
 * Name:     component
 * Purpose:  calling the component render function by namespace
 * -------------------------------------------------------------
 */

function smarty_function_component($params)
{
//    if (empty($params['v']))
//    {
//        trigger_error("insert variable: missing 'v' parameter");
//        return;
//    }

    $class = ucfirst(substr($params['n'], strrpos($params['n'], '\\') + 1));
    $namespace = $params['n'] . '\\' . $class;
    $component = new $namespace();
    return $component->display();
}
