<?php

namespace app\core\config;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Description of ConfigManager
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ConfigManager {

  /**
   * @var EventDispatcherInterface
   */
  protected $event_dispatcher;

  /**
   * @var StorageInterface
   */
  protected $storage;
  protected $name;

  public function __construct($name, StorageInterface $storage, EventDispatcherInterface $event_dispatcher) {
    $this->name = $name;
    $this->storage = $storage;
    $this->event_dispatcher = $event_dispatcher;
  }

  public function get($cid) {
    return $cid;
  }

  public function set($cid, $data) {

  }

  public function getUser() {

  }

}
