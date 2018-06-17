<?php

namespace ntc\account\listing;

use app\core\controller\ListController;

class UserAddressList extends ListController
{
    public function __construct()
    {
        $this->shop_dependent = false;
    }

    function head()
    {
        return ['ID', 'state', 'alias', 'address1', 'address2'];
    }

    function row($entity)
    {
        $row['id'] = $entity->id;
        $row['state'] = $entity->state->name;
        $row['alias'] = $entity->alias;
        $row['address1'] = $entity->address1;
        $row['address2'] = $entity->address2;
        return $row;
    }

    function bulkOperation()
    {
        // TODO: Implement bulkOperation() method.
    }

    function rowOperations($entity)
    {
        return ['edit' => ['name' => 'Edit', 'route' => 'admin.user.address.edit', 'params' => ['id' => $entity->id]],  'delete' => ['name' => 'Delete', 'route' => 'admin.user.address.delete', 'params' => ['id' => $entity->id]]];
    }

    function title()
    {
        return 'User Addresses';
    }

    public function headOperations($entity)
    {
        return ['add' => ['name' => 'Add', 'route' => 'admin.section.create', 'icon' => 'glyphicon glyphicon-plus-sign']];
    }

}