<?php

namespace ntc\administrator\controller;

use app\core\entity\controller\EntityListController;

/**
 * Description of Listing
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class Listing extends EntityListController {

    public function upper($param) {
        return ucfirst($param);
    }

    public function bulkOperation() {

    }

    public function head() {
        $head['id'] = 'ID';
        $head['firstname'] = "First Name";
        $head['lastname'] = "Last Name";
        $head['username'] = "Username";
        return $head;
    }

    public function model() {
        return 'app\core\entity\User';
    }

    public function row($entity) {
        $row['id'] = $entity->getID();
        $row['firstname'][] = $entity->getFirstName();
        $row['firstname']['callback'] = 'upper';
        $row['lastname'] = $entity->getLastName();
        $row['username'] = $entity->getUsername();
        return $row;
    }

    public function title() {

    }

    public function defaultOperation($entity) {
        $operations['edit'] = [
            'route' => 'admin.product.edit',
            'name' => 'Edit',
            'params' => ['id' => $entity->getID()]
        ];
        $operations['delete'] = [
            'route' => 'admin.product.add',
            'name' => 'Delete',
//            'params' => ['id' => $entity->getID()]
        ];
//        dump($operations);
        return $operations;
    }

}
