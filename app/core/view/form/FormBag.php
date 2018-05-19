<?php

namespace app\core\view\form;


class FormBag
{
    //request,custom ,eloquent
    protected $storage = [];

    public function __construct($store = null)
    {
        $this->storage = (array)$store;
    }

    public function addStorage($store)
    {
        $this->storage[] = $store;
    }

    public function has($key)
    {
        foreach ($this->storage as $storage) {
            $return = isset($storage->$key);
        }
        return $return;
    }

    public function get($key)
    {
        foreach ($this->storage as $storage) {
            $return = $storage->$key;
        }
        return $return;
    }
    public function all()
    {
      $return=[];
      foreach ($this->storage as $storage) {
          $return = $storage->all();
      }
      return $return;
    }

}
