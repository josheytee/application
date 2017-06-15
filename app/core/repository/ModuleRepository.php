<?php

namespace app\core\repository;

/**
 * Description of ModuleRepository
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ModuleRepository extends Repository {

    public function __construct() {
        $this->setDirectories([_MODULES_DIR_,]);
        parent::__construct();
    }

}
