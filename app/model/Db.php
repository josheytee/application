<?php

namespace app\model;

use Illuminate\Database\Capsule\Manager as Capsule;
// Set the event dispatcher used by Eloquent models... (optional)
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class Db {

    public static $instance;

    function __construct() {
        $this->init();
    }

    /**
     * Get a singleton instance of Context object
     *
     * @return Context
     */
    public static function g() {
        if (!isset(self::$instance)) {
            self::$instance = new Db();
        }

        return self::$instance;
    }

    public function init() {
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'ntc',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);

        $capsule->setEventDispatcher(new Dispatcher(new Container));

// Make this Capsule instance available globally via static methods... (optional)
        $capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();
        return $capsule;
    }

}
