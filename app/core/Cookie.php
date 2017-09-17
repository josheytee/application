<?php

namespace app\core;

use app\core\encryption\Blowfish;
use app\core\encryption\Rijndael;
use beta\library\Tools;

/**
 * Description of Cookie
 *
 * @author Tobi
 */
class Cookie {

    /** @var array Contain cookie content in a key => value format */
    protected $_data = array();

    /** @var array Crypted cookie name for setcookie() */
    protected $_name;

    /** @var array expiration date for setcookie() */
    protected $_expire;

    /** @var array Path for setcookie() */
    protected $_path;

    /** @var array cipher tool instance */
    protected $_cipherTool;
    protected $_modified = false;
    protected $_allow_writing;
    protected $_salt;
    protected $_standalone;
    protected $_secure = false;

    /** @var array Website domain for setcookie() */
    protected $_domain;

    /**
     * Get data if the cookie exists and else initialize an new one
     *
     * @param $name string Cookie name before encrypting
     * @param $path string
     */
    public function __construct($name, $path = '', $expire = null, $shared_urls = null, $standalone = false, $secure = false) {
        $this->_data = array();
        $this->_standalone = $standalone;
        $this->_expire = is_null($expire) ? time() + 1728000 : (int) $expire;
//        $this->_path = trim(($this->_standalone ? '' : Context::getContext()->shop->physical_uri) . $path, '/\\') . '/';
//        if ($this->_path{0} != '/') {
//            $this->_path = '/' . $this->_path;
//        }
//        $this->_path = rawurlencode($this->_path);
//        $this->_path = str_replace('%2F', '/', $this->_path);
//        $this->_path = str_replace('%7E', '~', $this->_path);
//        $this->_domain = $this->getDomain();
        $this->_name = 'ntc-' . md5(($this->_standalone ? '' : _VERSION_) . $name . $this->_domain);
        $this->_allow_writing = true;
        $this->_salt = $this->_standalone ? str_pad('', 8, md5('ps' . __FILE__)) : _COOKIE_IV_;
        if ($this->_standalone) {
            $this->_cipherTool = new Blowfish(str_pad('', 56, md5('ps' . __FILE__)), str_pad('', 56, md5('iv' . __FILE__)));
//        } elseif (!Configuration::get('PS_CIPHER_ALGORITHM') || !defined('_RIJNDAEL_KEY_')) {
//            $this->_cipherTool = new Blowfish(_COOKIE_KEY_, _COOKIE_IV_);
        } else {
            $this->_cipherTool = new Rijndael(_RIJNDAEL_KEY_, _RIJNDAEL_IV_);
        }
        $this->_secure = (bool) $secure;

        $this->update();
    }

    /**
     * Set expiration date
     *
     * @param int $expire Expiration time from now
     */
    public function setExpire($expire) {
        $this->_expire = (int) ($expire);
    }

    /**
     * Magic method wich return cookie data from _data array
     *
     * @param string $key key wanted
     * @return string value corresponding to the key
     */
    public function __get($key) {
        return isset($this->_data[$key]) ? $this->_data[$key] : null;
    }

    /**
     * Magic method which check if key exists in the cookie
     *
     * @param string $key key wanted
     * @return bool key existence
     */
    public function __isset($key) {
        return isset($this->_data[$key]);
    }

    /**
     * Magic method which adds data into _data array
     *
     * @param string $key Access key for the value
     * @param mixed $value Value corresponding to the key
     * @throws Exception
     */
    public function __set($key, $value) {
        if (is_array($value)) {
            die(var_dump($value) . 'must not be arry');
        }
        if (preg_match('/¤|\|/', $key . $value)) {
            throw new \Exception('Forbidden chars in cookie');
        }
        if (!$this->_modified && (!isset($this->_data[$key]) || (isset($this->_data[$key]) && $this->_data[$key] != $value))) {
            $this->_modified = true;
        }
        $this->_data[$key] = $value;
    }

    /**
     * Magic method wich delete data into _data array
     *
     * @param string $key key wanted
     */
    public function __unset($key) {
        if (isset($this->_data[$key])) {
            $this->_modified = true;
        }
        unset($this->_data[$key]);
    }

    /**
     * Get cookie content
     * @internal param bool $nullValues
     */
    public function update() {
        if (isset($_COOKIE[$this->_name])) {
            /* Decrypt cookie content */
            $content = $this->_cipherTool->decrypt($_COOKIE[$this->_name]);
//         return printf("\$content = %s<br />", $content);
//            var_dump($content);

            /* Get cookie checksum */
            $tmpTab = explode('¤', $content);
            array_pop($tmpTab);
            $content_for_checksum = implode('¤', $tmpTab) . '¤';
            $checksum = crc32($this->_salt . $content_for_checksum);
//            printf("\$checksum = %s<br />", $checksum);

            /* Unserialize cookie content */
            $tmpTab = explode('¤', $content);
            foreach ($tmpTab as $keyAndValue) {
                $tmpTab2 = explode('|', $keyAndValue);
                if (count($tmpTab2) == 2) {
                    $this->_data[$tmpTab2[0]] = $tmpTab2[1];
                }
            }
            /* Blowfish fix */
            if (isset($this->_data['checksum'])) {
                $this->_data['checksum'] = (int) ($this->_data['checksum']);
            }
            //printf("\$this->_data['checksum'] = %s<br />", $this->_data['checksum']);
            //die();
            /* Check if cookie has not been modified */
            if (!isset($this->_data['checksum']) || $this->_data['checksum'] != $checksum) {
                $this->logout();
            }

            if (!isset($this->_data['date_add'])) {
                $this->_data['date_add'] = date('Y-m-d H:i:s');
            }
        } else {
            $this->_data['date_add'] = date('Y-m-d H:i:s');
        }

        //checks if the language exists, if not choose the default language
//        if (!$this->_standalone && !Language::getLanguage((int) $this->id_lang)) {
//            $this->id_lang = Configuration::get('PS_LANG_DEFAULT');
//            // set detect_language to force going through Tools::setCookieLanguage to figure out browser lang
//            $this->detect_language = true;
//        }
    }

    protected function getDomain($shared_urls = null) {
        $r = '!(?:(\w+)://)?(?:(\w+)\:(\w+)@)?([^/:]+)?(?:\:(\d*))?([^#?]+)?(?:\?([^#]+))?(?:#(.+$))?!i';

        if (!preg_match($r, Tools::getHttpHost(false, false), $out) || !isset($out[4])) {
            return false;
        }

        if (preg_match('/^(((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]{1}[0-9]|[1-9]).)' .
                        '{1}((25[0-5]|2[0-4][0-9]|[1]{1}[0-9]{2}|[1-9]{1}[0-9]|[0-9]).)' .
                        '{2}((25[0-5]|2[0-4][0-9]|[1]{1}[0-9]{2}|[1-9]{1}[0-9]|[0-9]){1}))$/', $out[4])) {
            return false;
        }
        if (!strstr(Tools::getHttpHost(false, false), '.')) {
            return false;
        }

        $domain = false;
        if ($shared_urls !== null) {
            foreach ($shared_urls as $shared_url) {
                if ($shared_url != $out[4]) {
                    continue;
                }
                if (preg_match('/^(?:.*\.)?([^.]*(?:.{2,4})?\..{2,3})$/Ui', $shared_url, $res)) {
                    $domain = '.' . $res[1];
                    break;
                }
            }
        }
        if (!$domain) {
            $domain = $out[4];
        }
        return $domain;
    }

    /**
     * Setcookie according to php version
     */
    protected function _setcookie($cookie = null) {
        if ($cookie) {
            $content = $this->_cipherTool->encrypt($cookie);
            $time = $this->_expire;
        } else {
            $content = 0;
            $time = 1;
        }
        if (PHP_VERSION_ID <= 50200) { /* PHP version > 5.2.0 */
            return setcookie($this->_name, $content, $time, $this->_path, $this->_domain, $this->_secure);
        } else {
            return setcookie($this->_name, $content, $time, $this->_path, $this->_domain, $this->_secure, true);
        }
    }

    public function __destruct() {
        $this->write();
    }

    /**
     * Delete cookie
     * As of version 1.5 don't call this function, use Customer::logout() or Employee::logout() instead;
     */
    public function logout() {
        $this->_data = array();
        $this->_setcookie();
        unset($_COOKIE[$this->_name]);
        $this->_modified = true;
    }

    /**
     * Save cookie with setcookie()
     */
    public function write() {
        if (!$this->_modified || headers_sent() || !$this->_allow_writing) {
            return;
        }

        $cookie = '';

        /* Serialize cookie content */
        if (isset($this->_data['checksum'])) {
            unset($this->_data['checksum']);
        }
        foreach ($this->_data as $key => $value) {
            $cookie .= $key . '|' . $value . '¤';
        }

        /* Add checksum to cookie */
        $cookie .= 'checksum|' . crc32($this->_salt . $cookie);
        $this->_modified = false;
        /* Cookies are encrypted for evident security reasons */
        return $this->_setcookie($cookie);
    }

}

//$uri = $_SERVER['REQUEST_URI'];
//$foo = $_GET['foo'];
//header('Content-Type:application/json');
//echo 'The URI requested is: ' . $uri;
//echo 'The value of the "foo" parameter is: ' . $foo;

