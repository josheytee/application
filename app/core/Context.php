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

    /**
     * entity manager object for doctrine
     * @var \Doctrine\ORM\EntityManager
     */
    public $manager;
    protected static $instance;

    public function __construct() {

    }

    public static function getContext() {
        if (!isset(self::$instance)) {
            self::$instance = new Context();
        }
        return self::$instance;
    }

}
