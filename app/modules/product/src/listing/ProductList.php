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
        $row['id'] = $entity->id;
        $row['image'][] = $entity->images->first();
        $row['image']['callback'] = 'setImage';
        $row['name'] = $entity->name;
        $row['price'] = $entity->price;
        $row['active'][] = $entity->active;
        $row['active']['callback'] = 'setActiveIcon';
        $row['quantity'] = $entity->quantity;
        $row['section'] = $entity->section->name;
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
            'preview' => [
                'name' => 'View',
                'route' => 'product.index',
                'params' => [
                    'shop_url' => $this->currentShop()->url,
                    'product_id' => $entity->id,
                    'product_url' => $entity->link_rewrite
                ]
            ],
            'edit' => [
                'name' => 'Edit',
                'route' => 'admin.product.edit',
                'params' => [
                    'id' => $entity->id
                ]
            ],
            'delete' => [
                'name' => 'Delete',
                'route' => 'admin.product.delete',
                'params' => [
                    'id' => $entity->id
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
