<?php
/**
 * Created by PhpStorm.
 * User: joshua
 * Date: 8/25/17
 * Time: 8:49 PM
 */

namespace ntc\shop\listing;

use app\core\controller\ListController;


class ShopUserList extends ListController
{

    function head()
    {
        $head['id'] = "ID";
        $head['name'] = "Name";
        return $head;
    }

    function row($entity)
    {
        $row['id'] = $entity->getID();
        $row['name'] = $entity->getName();
        return $row;
    }

    function bulkOperation()
    {
        // TODO: Implement bulkOperation() method.
    }

    function defaultOperation($entity)
    {
        return [
            'edit' => ['name' => 'Edit',
                'route' => 'admin.shop.add']
        ];
    }

    function title()
    {
        return 'Shop assigned to current user';
    }

    function model()
    {
        return 'app\core\entity\Shop';
    }
}