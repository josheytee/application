<?php

namespace app\core\event;

class EventDispatcher implements EventDispatcherInterface {

    public function addListener($eventName, $listener, $priority = 0) {

    }

    public function dispatch($eventName, Event $event = null) {

    }

    public function getListeners($eventName = null) {

    }

    public function hasListeners($eventName = null) {

    }

    public function removeListener($eventName, $listener) {

    }

}
