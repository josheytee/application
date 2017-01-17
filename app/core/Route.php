<?php

namespace app\core;

use app\core\Page;

class Route {

    private $_url = array();
    private $_method = array();

    const WEB = 'front';
    const ADMIN = 'admin';
    const INVENTORY = 3;
    const API = 4;

    public function add($url, $method = NULL) {
        $this->_url[] = '/application/' . trim($url, '/');
        if ($method != NULL) {
            $this->_method[] = $method;
        }
    }

    public function run() {
        $uri = $_SERVER['REQUEST_URI'];
        $error = null;
        foreach ($this->_url as $key => $value) {
            if (preg_match("#^$value$#i", $uri, $param)) {
                if ((is_string($this->_method[$key]) && preg_match('#[_/].+#i', $this->_method[$key]))) {
                    $page = Page::getPage($this->_method[$key], self::ADMIN);
                    $page->create();
                } elseif (is_string($this->_method[$key])) {
                    echo $this->_method[$key];
                    $page = Page::getPage($this->_method[$key]);
                    $page->create();
                } else {
                    array_shift($param);
                    call_user_func_array($this->_method[$key], $param);
                }
            }
        }
    }

}
