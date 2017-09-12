<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.eightball.php
 * Type:     function
 * Name:     eightball
 * Purpose:  outputs a random magic answer
 * -------------------------------------------------------------
 */

function smarty_function_dump($params, \Smarty_Internal_Template $template) {
    if (empty($params['v'])) {
        trigger_error("insert time: missing 'format' parameter");
        return;
    }
    return dump($params['v']);
}
