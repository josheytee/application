<?php

namespace app\core\repository;

/**
 * Description of ModuleRepository
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ModuleRepository extends Repository {

  protected $services;

  public function __construct() {
    $this->setDirectories([_MODULES_DIR_,]);
    parent::__construct();
  }

  public function getServices() {
    foreach ($this->getRepositories() as $module => $path) {
      $service = DS . $module . '.services.yml';
      if (file_exists($path . $service)) {
        $this->services[$module] = $path . $service;
      }
    }
    return $this->services;
  }

}
