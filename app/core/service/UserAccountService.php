<?php

namespace app\core\service;

/**
 * Description of UserAccountService
 *
 * @author Tobi
 */
class UserAccountService extends KernelService
{

    public $name = 'user account service';
    private $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = KernelService::getService("DatabaseManagementService");
    }

    /**
     * generates token with date_userID_uniqueID_shopID
     */
    public function getUserToken()
    {

    }

    /**
     * get the current logged in user
     * @return type
     */
    public function getCurrentUser()
    {
        return (int)1;
    }

    public function getCurrentShop()
    {
        return (int)1;
    }

    public function errorRedirect()
    {

    }

}
