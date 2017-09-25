<?php


namespace app\core\validation;


class Tools {
    public static function getNamespacedClass($class_name) {
        return '\\' . __NAMESPACE__ . '\\' . $class_name;
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

    /**
     * Delete unicode class from regular expression patterns
     * @param string $pattern
     * @return string pattern
     */
    public static function cleanNonUnicodeSupport($pattern) {
        if (!defined('PREG_BAD_UTF8_OFFSET')) {
            return $pattern;
        }
        return preg_replace('/\\\[px]\{[a-z]{1,2}\}|(\/[a-z]*)u([a-z]*)$/i', '$1$2', $pattern);
    }

    /**
     * Display an error according to an error code
     *
     * @param string $string Error message
     * @param bool $htmlentities By default at true for parsing error message with htmlentities
     * @return mixed|string
     */
    public static function displayError($string = 'Fatal error', $htmlentities = true, Context $context = null) {
        global $_ERRORS;

//        if (is_null($context)) {
//            $context = \beta\library\Context::getContext();
//        }

//        @include_once(_PS_TRANSLATIONS_DIR_ . $context->language->iso_code . '/errors.php');

        if (defined('_PS_MODE_DEV_') && _PS_MODE_DEV_ && $string == 'Fatal error') {
            return ('<pre>' . print_r(debug_backtrace(), true) . '</pre>');
        }
        if (!is_array($_ERRORS)) {
            return $htmlentities ? Tools::htmlentitiesUTF8($string) : $string;
        }
        $key = md5(str_replace('\'', '\\\'', $string));
        $str = (isset($_ERRORS) && is_array($_ERRORS) && array_key_exists($key, $_ERRORS)) ? $_ERRORS[$key] : $string;
        return $htmlentities ? Tools::htmlentitiesUTF8(stripslashes($str)) : $str;
    }

    public static function htmlentitiesUTF8($string, $type = ENT_QUOTES) {
        if (is_array($string)) {
            return array_map(array('Tools', 'htmlentitiesUTF8'), $string);
        }

        return htmlentities((string)$string, $type, 'utf-8');
    }
    public static function isEmpty($field) {
        return ($field === '' || $field === null);
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
}