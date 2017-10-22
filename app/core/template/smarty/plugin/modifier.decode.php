<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     modifier.decode.php
 * Type:     modifier
 * Name:     decode
 * Purpose:  base64 decodes a string
 * -------------------------------------------------------------
 */
function smarty_modifier_decode($string)
{
    return base64_decode($string);
}