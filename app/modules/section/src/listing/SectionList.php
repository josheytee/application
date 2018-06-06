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
    $row['id'] = $entity->id;
    $row['name'] = $entity->name;
    $row['url'] = $entity->url;
    $row['description'] = $entity->description;
    $row['section'] = $entity->parent->name;
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
                'id' => $entity->id
            ]
        ],
        'preview' => [
            'name' => 'Preview',
            'route' => 'section.index',
            'params' => [
                'shop_url' => $entity->url
            ]
        ],
        'delete' => [
            'name' => 'Delete',
            'route' => 'admin.section.delete',
            'params' => [
                'id' => $entity->id
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
