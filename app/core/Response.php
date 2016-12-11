<?php

namespace app\core;

/**
 * Description of Response
 *
 * @author Tobi
 */
class Response {

    protected $content;
    protected $status;
    protected $header;
    protected $statusCode;
    protected $statusText = 'ok';
    protected $version;

    public function __construct($content = '', $status = 200, $header = array()) {
        $this->header = $header;
        $this->setContent($content);
        $this->setStatus($status);
        $this->version = '1.0';
    }

    public function getContent() {
        return $this->content;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function setStatus($status) {
        $this->status = $status;
        $this->statusCode = $status;
    }

    public function process(Request $request) {
        return $this;
    }

    public function send() {
        header(sprintf('HTTP/%s %s %s', $this->version, $this->statusCode, $this->statusText), true, $this->statusCode);
        if ($this->header ?? NULL) {
            foreach ($this->header as $key => $value) {
                header("$value", TRUE);
            }
        }
        echo $this->getContent();
    }

}
