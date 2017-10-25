<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.current_url.php
 * Type:     function
 * Name:     current_url
 * Purpose:  displaying symfony current route inside smarty
 * -------------------------------------------------------------
 */

use app\core\Context;

function smarty_function_current_url($params)
{
    return Context::urlGenerator()->currentUrl();
}
