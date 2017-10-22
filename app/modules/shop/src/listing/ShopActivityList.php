<?php


namespace ntc\shop\listing;


use app\core\controller\ListController;

class ShopActivityList extends ListController
{

    function head()
    {
        return [
            'id' => '#',
            'icon' => 'Icon',
            'name' => 'Name',
            'description' => 'Description'
        ];
    }

    function row($entity)
    {
        return [
            'id' => $entity->getId(),
            'icon' => $entity->getIcon(),
            'name' => $entity->getName(),
            'description' => [
                $entity->getDescription(),
                'callback' => 'shrink'
            ]
        ];
    }

    public function shrink($description)
    {
        return $description . '...';
    }

    function rowOperations($entity)
    {

        return [
            'edit' => [
                'name' => 'Edit',
                'route' => 'admin.shop.activity.edit',
                'params' => [
                    'id' => $entity->getID()
                ]
            ],

            'delete' => [
                'name' => 'Delete',
                'route' => 'admin.shop.activity.delete',
                'params' => [
                    'id' => $entity->getID()
                ]
            ]
        ];
    }

    function headOperations($entity)
    {
        return [
            'add' => [
                'name' => 'Add',
                'route' => 'admin.shop.activity.create',
                'icon' => 'glyphicon glyphicon-plus-sign'
            ]
        ];
    }

    function bulkOperation()
    {
        // TODO: Implement bulkOperation() method.
    }


    public function title()
    {
        return 'Shop Activities';
    }
}