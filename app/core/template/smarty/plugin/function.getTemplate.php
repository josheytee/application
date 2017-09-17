<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.getTemplate.php
 * Type:     function
 * Name:     eightball
 * Purpose:  outputs a random magic answer
 * -------------------------------------------------------------
 */

function smarty_function_getTemplate() {
    $answers = array('Yes',
        'No',
        'No way',
        'Outlook not so good',
        'Ask again soon',
        'Maybe in your reality');
    dump($answers);
    $result = array_rand($answers);
    return $answers[$result];
}
