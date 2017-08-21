<?php

namespace app\core\event;

/**
 * Description of Event
 *
 * @author Tobi
 */
class Event {

    const TYPE_DATA = 'DATA';
    const TYPE_REQUEST = 'REQUEST';
    const TYPE_ACTION = 'ACTION';

    public $name;
    public $type;
    public $response;
    public $dispatcher;

    public function __construct($name, $type = self::TYPE_ACTION) {

    }

    public function notify(EventDispatcher $dispatcher) {

    }

    public function notifyAll() {
        
    }

}
