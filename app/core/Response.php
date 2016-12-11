<?php

namespace app\core;

/**
 * Description of Response
 *
 * @author Tobi
 */
class Response {

    public $content;
    public $status;
    public $header;

    public function __construct($content = '', $status = 200, $header = array()) {
        
    }

    public function process(Request $request) {
        return $this;
    }

    public function send() {

    }

}
