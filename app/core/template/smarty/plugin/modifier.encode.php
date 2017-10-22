<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     modifier.encode.php
 * Type:     modifier
 * Name:     decode
 * Purpose:  base64 encodes a string
 * -------------------------------------------------------------
 */
function smarty_modifier_encode($string)
{
    return base64_encode($string);
}