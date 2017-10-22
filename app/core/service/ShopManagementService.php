<?php

namespace app\core\service;

/**
 * Description of StoreManagementService
 *
 * @author Tobi
 */
class ShopManagementService extends KernelService
{

    public $fileds;
    private $database;
    private $uas;
    private $current_shop;

    public function __construct()
    {
        parent::__construct();
        $this->database = KernelService::getService("DatabaseManagementService");
        $this->uas = KernelService::getService("UserAccountService");
        $this->fileds = $this->database->fetchAllQuery("DESCRIBE shop");
//        var_dump($this->fileds);
        $this->getShopByURL('/defaultshop');
    }

    public function getShopByURL($url)
    {
        $q = "SELECT * FROM shop WHERE url='$url'";
        $shop = $this->database->fetchQuery($q);
    }

    public function getShopsFromUser()
    {
        $user_id = $this->uas->getCurrentUser();
        $sql = "SELECT * FROM shop s INNER JOIN user_shop us ON us.id_shop=s.id_shop AND us.id_user=" . $user_id;
        $shop = $this->database->fetchAllQuery($sql);
        var_dump($shop);
        return $shop;
    }

    public function newShop()
    {

    }

}
