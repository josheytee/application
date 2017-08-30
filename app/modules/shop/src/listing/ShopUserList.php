<?php

namespace ntc\shop\listing;

use app\core\entity\controller\EntityListController;

class ShopUserList extends EntityListController {

    function head() {
        $head['id'] = "ID";
        $head['name'] = "Name";
        return $head;
    }

    function row($entity) {
        $row['id'] = $entity->getID();
        $row['name'] = $entity->getName();
        return $row;
    }

    function bulkOperation() {
        // TODO: Implement bulkOperation() method.
    }

    function defaultOperation($entity) {
        return [
            'edit' => ['name' => 'Edit',
                'route' => 'admin.shop.edit',
                'params' => ['entity' => $entity->getID()]
            ],
            'delete' => ['name' => 'Delete',
                'route' => 'admin.shop.delete',
                'params' => ['entity' => $entity->getID()]
            ]
        ];
    }

    function title() {
        return 'Shop assigned to current user';
    }

    function model() {
        return 'app\core\entity\Shop';
    }

}
