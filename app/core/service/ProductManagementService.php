<?php

namespace app\core\service;

/**
 * Description of ProductManagementService
 *
 * @author Tobi
 */
class ProductManagementService extends KernelService
{

    private $uas;
    private $db;

    public function __construct()
    {
        parent::__construct();
        $this->uas = KernelService::getService("UserAccountService");
        $this->db = KernelService::getService("DatabaseManagementService");
    }

    public function getProductsFromShop()
    {
        $currentShopID = $this->uas->getCurrentShop();
        $sql = "SELECT * FROM product p INNER JOIN product_shop ps ON p.id_product=ps.id_product AND ps.id_shop=" . $currentShopID;
        $re = $this->db->fetchAllQuery($sql);
        return $re;
    }

}
