<?php

namespace ntc\section\listing;

use app\core\controller\ListController;

class SectionList extends ListController
{

    function head()
    {
        $head['id'] = "ID";
        $head['name'] = "Name";
        $head['url'] = "Url";
        $head['description'] = "Description";
        $head['section'] = "Parent";
        return $head;
    }

    function row($entity)
    {
        $row['id'] = $entity->getID();
        $row['name'] = $entity->getName();
        $row['url'] = $entity->getUrl();
        $row['description'] = $entity->getDescription();
        $row['section'] = $entity->getSection()->getName();
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
                'route' => 'admin.section.update',
                'params' => [
                    'id' => $entity->getID()
                ]
            ],
            'preview' => [
                'name' => 'Preview',
                'route' => 'section.index',
                'params' => [
                    'url' => $entity->getUrl()
                ]
            ],
            'delete' => [
                'name' => 'Delete',
                'route' => 'admin.section.delete',
                'params' => [
                    'id' => $entity->getID()
                ]
            ],
        ];
    }

    function title()
    {
        return 'Shop Sections';
    }

    public function headOperations($entity)
    {
        return [
            'add' => [
                'name' => 'Add',
                'route' => 'admin.section.create',
                'icon' => 'glyphicon glyphicon-plus-sign'
            ]
        ];
    }

}
