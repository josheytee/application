<?php

namespace app\core\utility;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
trait StringHelper {

    /**
     * Translates a string with underscores into camel case (e.g. first_name -> firstName)
     * @prototype string public static function toCamelCase(string $str[, bool $capitalise_first_char = false])
     */
    public static function toCamelCase($str, $catapitalise_first_char = false) {
        $str = StringHelper::strtolower($str);
        if ($catapitalise_first_char) {
            $str = StringHelper::ucfirst($str);
        }
        return preg_replace_callback('/_+([a-z])/', create_function('$c', 'return strtoupper($c[1]);'), $str);
    }

    public static function substr($str, $start, $length = false, $encoding = 'utf-8') {
        if (is_array($str)) {
            return false;
        }
        if (function_exists('mb_substr')) {
            return mb_substr($str, (int)$start, ($length === false ? StringHelper::strlen($str) : (int)$length), $encoding);
        }
        return substr($str, $start, ($length === false ? StringHelper::strlen($str) : (int)$length));
    }

    public static function strtoupper($str) {
        if (is_array($str)) {
            return false;
        }
        if (function_exists('mb_strtoupper')) {
            return mb_strtoupper($str, 'utf-8');
        }
        return strtoupper($str);
    }

    public static function strtolower($str) {
        if (is_array($str)) {
            return false;
        }
        if (function_exists('mb_strtolower')) {
            return mb_strtolower($str, 'utf-8');
        }
        return strtolower($str);
    }

    public static function ucfirst($str) {
        return StringHelper::strtoupper(StringHelper::substr($str, 0, 1)) . StringHelper::substr($str, 1);
    }

    public static function strlen($str, $encoding = 'UTF-8') {
        if (is_array($str)) {
            return false;
        }
        $str = html_entity_decode($str, ENT_COMPAT, 'UTF-8');
        if (function_exists('mb_strlen')) {
            return mb_strlen($str, $encoding);
        }
        return strlen($str);
    }

    public function slug($str) {

    }

    /**
     * get modulename from module id
     * @param $id
     * @return bool|string
     */
    public function getModuleName($id) {
        return substr($id, strrpos($id, '_') + 1);
    }
}
