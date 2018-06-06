<?php

namespace ntc\carrier\listing;

use app\core\controller\ListController;

class CarrierList extends ListController
{

    function head()
    {
        return ['ID', 'name', 'url', 'active'];
    }

    function row($entity)
    {
        $row['id'] = $entity->id;
//        $row['image'][] = $entity->images->first();
//        $row['image']['callback'] = 'setImage';
        $row['name'] = $entity->name;
        $row['url'] = $entity->url;
//        $row['price'] = $entity->price;
        $row['active'][] = $entity->active;
        $row['active']['callback'] = 'setActiveIcon';
//        $row['quantity'] = $entity->quantity;
//        $row['section'] = $entity->section->name;
        return $row;
    }

    public function setActiveIcon($product)
    {
        return $product ? "<span class='glyphicon glyphicon-ok' style='color: #0F9E5E' aria-hidden='true'></span>" :
            "<span class='glyphicon glyphicon-remove' style='color: #d41308' aria-hidden='true'></span>";
    }

    public function setImage($product)
    {
        return $product ? "<img src='{$product->path}' width='45' height='45'>" : "";
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
                'route' => 'admin.carrier.edit',
                'params' => [
                    'id' => $entity->id
                ]
            ],
            'delete' => [
                'name' => 'Delete',
                'route' => 'admin.carrier.delete',
                'params' => [
                    'id' => $entity->id
                ]
            ]
        ];
    }

    function title()
    {
        return 'Carrier list';
    }

    public function headOperations($entity)
    {
        return [
            'add' => [
                'name' => 'Add',
                'route' => 'admin.carrier.create',
                'icon' => 'glyphicon glyphicon-plus-sign'
            ]
        ];
    }
}
