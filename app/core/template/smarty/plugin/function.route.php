<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.route.php
 * Type:     function
 * Name:     route
 * Purpose:  utilizing symfony route inside smarty
 * -------------------------------------------------------------
 */

use app\core\Context;

function smarty_function_route($params)
{
    if (empty($params['n'])) {
        trigger_error("insert variable: missing 'n' parameter");
        return;
    }
    if (empty($params['p'])) {
        $params['p'] = [];
    }
    return Context::urlGenerator()->generate($params['n'], $params['p']);
}
