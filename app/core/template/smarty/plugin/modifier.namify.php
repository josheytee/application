<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     modifier.namify.php
 * Type:     modifier
 * Name:     namify
 * Purpose:  converts strings with _ and - to human readable formats
 * -------------------------------------------------------------
 */
function smarty_modifier_namify($name)
{
    return ucwords(str_replace(['-', '_'], ' ', $name));
}