<?php


namespace app\core\repository\handler;

class ModuleRepositoryHandler extends BaseHandler
{

    public function getService()
    {
        return $this->parseFile('.services.yml');
    }

    public function getRoute()
    {
        return $this->parseFile('.route.yml');
    }

    public function getPermissions()
    {
        return $this->parseFile('.permissions.yml');
    }

    public function getLibrary()
    {
        return $this->parseFile('.libraries.yml');
    }

    public function getCustom($custom){
        return $this->parseFile(".$custom.yml");
    }
}