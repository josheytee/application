<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.dump.php
 * Type:     function
 * Name:     dump
 * Purpose:  utilizing symfony dump inside smarty
 * -------------------------------------------------------------
 */

function smarty_function_dump($params, \Smarty_Internal_Template $template) {
    if (empty($params['v'])) {
        trigger_error("insert variable: missing 'v' parameter");
        return;
    }
    return dump($params['v']);
}
