<?php

namespace ntc\shop\listing;

use app\core\controller\ListController;

class ShopUserList extends ListController {

    function head() {
        $head['id'] = "ID";
        $head['name'] = "Name";
        $head['url'] = "Url";
        $head['description'] = "Description";
        $head['activity'] = "Activity";
        $head['state'] = "State";
        return $head;
    }

    function row($entity) {
        $row['id'] = $entity->getID();
        $row['name'] = $entity->getName();
        $row['url'] = $entity->getUrl();
        $row['description'] = $entity->getDescription();
        $row['activity'] = $entity->getActivity()->getName();
        $row['state'] = $entity->getState()->getName();
        return $row;
    }

    function bulkOperation() {
        // TODO: Implement bulkOperation() method.
    }

    function defaultOperation($entity) {
        return [
          'edit' => [
            'name' => 'Edit',
            'route' => 'admin.shop.edit',
            'params' => [
              'id' => $entity->getID()
            ]
          ],
          'delete' => [
            'name' => 'Delete',
            'route' => 'admin.shop.delete',
            'params' => [
              'id' => $entity->getID()
            ]
          ],
          'preview' => [
            'name' => 'Preview',
            'route' => 'shop.index',
            'params' => [
              'url' => $entity->getUrl()
            ]
          ]
        ];
    }

    function title() {
        return 'Shop assigned to current user';
    }

}
