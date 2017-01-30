<?php

namespace app\core;

/**
 * Description of Context
 *
 * @author Tobi
 */
class Context {

    /**
     * @var string
     */
    public $rootUrl;

    /**
     * @var User
     */
    public $user;

    /**
     * @var \mixed
     */
    public $request;

    public function __construct() {

    }

}
