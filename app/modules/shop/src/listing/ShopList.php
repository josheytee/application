<?php

namespace ntc\shop\listing;

use app\core\controller\ListController;

class ShopList extends ListController
{
    public function __construct()
    {
        $this->shop_dependent = false;
//        $this->user_dependent = true;
    }

    function head()
    {
        $head['id'] = "ID";
        $head['name'] = "Name";
        $head['url'] = "Url";
        $head['slogan'] = "Slogan";
//        $head['activity'] = "Activity";
//        $head['state'] = "State";
        return $head;
    }

    function row($entity)
    {
        $row['id'] = $entity->id;
        $row['name'] = $entity->name;
        $row['url'] = $entity->url;
        $row['slogan'] = $entity->slogan;
//        $row['activity'] = $entity->activity->name;
//        $row['state'] = $entity->state->name;
        return $row;
    }

    function bulkOperation()
    {
        // TODO: Implement bulkOperation() method.
    }

    function rowOperations($entity)
    {
        return [
            'edit' => [
                'name' => 'Edit',
                'route' => 'admin.shop.edit',
                'params' => [
                    'id' => $entity->id
                ]
            ],
            'preview' => [
                'name' => 'Preview',
                'route' => 'shop.index',
                'params' => [
                    'shop_url' => $entity->url
                ]
            ],
            'delete' => [
                'name' => 'Delete',
                'route' => 'admin.shop.delete',
                'params' => [
                    'id' => $entity->id
                ]
            ]
        ];
    }

    function title()
    {
        return 'Shop assigned to current user';
    }

    function headOperations($entity)
    {
        return [
            'add' => [
                'name' => 'Add',
                'route' => 'admin.shop.add',
                'icon' => 'glyphicon glyphicon-plus-sign'
            ]
        ];
    }
}
