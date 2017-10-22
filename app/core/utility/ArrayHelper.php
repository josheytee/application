<?php

namespace app\core\utility;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
trait ArrayHelper
{

    /**
     * processes an array to be shown as html attributes
     * @param array $arr
     * @return string
     */
    public function processArray($arr)
    {
        $escaped_string = '';
        foreach ((array)$arr as $key => $value) {
            $escaped_string .= $key . '=' . $this->e($value) . ' ';
        }
        return $escaped_string;
    }

    /**
     * escapees string for html tags
     * @param type $value
     * @return type
     */
    public function e($value)
    {
        if (is_int($value)) {
            return (int)$value;
        } else {
            return (string)'"' . $value . '"';
        }
    }

}
