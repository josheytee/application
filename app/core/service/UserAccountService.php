<?php

namespace app\core\service;

use app\core\service\KernelService;

/**
 * Description of UserAccountService
 *
 * @author Tobi
 */
class UserAccountService extends KernelService {

//    public $name = 'user account service';
    private $db;

    public function __construct() {
        parent::__construct();
        $this->db = $this->subscribe(new DatabaseManagementService());
    }

}
