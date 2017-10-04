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
        foreach ($this->getRepositories() as $module => $info) {
            $service = DS . substr($module, strrpos($module, '_') + 1) . '.services.yml';
            if (file_exists($info['path'] . $service)) {
                $this->services[$module] = $info['path'] . $service;
            }
        }
        return $this->services;
    }

}
