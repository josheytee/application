<?php

namespace app\core\service;

use app\core\service\KernelService;

/**
 * Description of StoreManagementService
 *
 * @author Tobi
 */
class ShopManagementService extends KernelService {

    public $database;
    public $fileds;

    public function __construct() {
        parent::__construct();
        $this->database = KernelService::getService("DatabaseManagementService");
        $this->fileds = $this->database->fetchAllQuery("DESCRIBE shop");
//        var_dump($this->fileds);
    }

    public function newShop() {

    }

}
