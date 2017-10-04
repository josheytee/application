<?php


namespace app\core\repository;

use Symfony\Component\Yaml\Yaml;

abstract class BaseHandler {
    protected $name;
    protected $path;

    public function __construct($name, $path) {
        $this->name = $name;
        $this->path = $path;
    }

    public function getName() {
        return $this->name;
    }

    public function getPath() {
        return $this->path;
    }

    public function getInfo($key = null) {
        return $this->parseFile('.info.yml', $key);
    }

    public function parseFile($extension, $key = null) {
        $info = file_exists($this->path . DS . $this->name . $extension) ?
          Yaml::parse(file_get_contents($this->getPath() . DS . $this->getName() . $extension)) : [];
        if (isset($key)) {
            return $info[$key] ?? '';
        }
        return $info;
    }

}