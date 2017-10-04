<?php


namespace app\core\repository;


class ComponentRepositoryHandler extends BaseHandler {

    public function getClass() {
        return $this->getInfo('package') . '\\' . ucfirst($this->getName());
    }
}