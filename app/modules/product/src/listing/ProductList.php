<?php

namespace ntc\product\listing;

use app\core\controller\ListController;

class ProductList extends ListController
{

    function head()
    {
        $head['id'] = "ID";
        $head['image'] = "Image";
        $head['name'] = "Name";
        $head['price'] = "Price";
        $head['active'] = "Active";
        $head['quantity'] = "Quantity";
        $head['section'] = "Section";
        return $head;
    }

    function row($entity)
    {
        $row['id'] = $entity->getID();
        $row['image'][] = $entity->getName();
        $row['image']['callback'] = 'setImage';
        $row['name'] = $entity->getName();
        $row['price'] = $entity->getPrice();
        $row['active'][] = $entity->getActive();
        $row['active']['callback'] = 'setActiveIcon';
        $row['quantity'] = $entity->getQuantity();
        $row['section'] = $entity->getSection()->getName();
        return $row;
    }

    public function setActiveIcon($product)
    {
        return $product ? "<span class='glyphicon glyphicon-ok' style='color: #0F9E5E' aria-hidden='true'></span>" :
            "<span class='glyphicon glyphicon-remove' style='color: #d41308' aria-hidden='true'></span>";
    }

    public function setImage($product)
    {
        return $product ? "<img src='/{$product}'>" : "";
    }

    function bulkOperation()
    {
        // TODO: Implement bulkOperation() method.
    }

    function rowOperations($entity)
    {
        return [
            'preview' => [
                'name' => 'View',
                'route' => 'product.index',
                'params' => [
                    'id' => $entity->getId(),
                    'url' => $entity->getLinkRewrite()
                ]
            ],
            'edit' => [
                'name' => 'Edit',
                'route' => 'admin.product.edit',
                'params' => [
                    'id' => $entity->getID()
                ]
            ],
            'delete' => [
                'name' => 'Delete',
                'route' => 'admin.product.delete',
                'params' => [
                    'id' => $entity->getID()
                ]
            ]
        ];
    }

    function title()
    {
        return 'Product list';
    }

    public function headOperations($entity)
    {
        return [
            'add' => [
                'name' => 'Add',
                'route' => 'admin.product.create',
                'icon' => 'glyphicon glyphicon-plus-sign'
            ]
        ];
    }
}