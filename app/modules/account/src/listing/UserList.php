<?php

namespace ntc\account\listing;

use app\core\controller\ListController;

class UserList extends ListController
{
    public function __construct()
    {
        $this->shop_dependent = false;
    }

    function head()
    {
        return ['ID', 'firstname', 'lastname', 'email', 'phone'];
    }

    function row($entity)
    {
        $row['id'] = $entity->id;
        $row['firstname'] = $entity->firstname;
        $row['lastname'] = $entity->lastname;
        $row['email'] = $entity->email;
        $row['phone'] = $entity->phone;
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
                'route' => 'admin.user.address.edit',
                'params' => [
                    'id' => $entity->id
                ]
            ],
            'delete' => [
                'name' => 'Delete',
                'route' => 'admin.user.address.delete',
                'params' => [
                    'id' => $entity->id
                ]
            ]
        ];
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