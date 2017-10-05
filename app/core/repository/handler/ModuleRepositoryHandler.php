<?php


namespace app\core\repository\handler;

class ModuleRepositoryHandler extends BaseHandler {

    public function getService() {
        return $this->parseFile('.services.yml');
    }

    public function getRoute() {
        return $this->parseFile('.route.yml');
    }

    public function getPermission() {
        return $this->parseFile('.permission.yml');
    }

    public function getLibrary() {
        return $this->parseFile('.libraries.yml');
    }
}