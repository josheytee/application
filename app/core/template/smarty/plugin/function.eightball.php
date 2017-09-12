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

function smarty_function_eightball($params, \Smarty_Internal_Template $template) {
    $answers = array('Yes',
        'No',
        'No way',
        'Outlook not so good',
        'Ask again soon',
        'Maybe in your reality');

    $result = array_rand($answers);
    return $answers[$result];
}
