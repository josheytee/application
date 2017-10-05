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
        $this->handler = handler\ModuleRepositoryHandler::class;
        parent::__construct();
    }

    public function getServices() {
        foreach ($this->getRepositories() as $package => $handler) {
            $service = DS .$handler->getName(). '.services.yml';
            if (file_exists($handler->getPath() . $service)) {
                $this->services[$package] = $handler->getPath() . $service;
            }
        }
        return $this->services;
    }

}
