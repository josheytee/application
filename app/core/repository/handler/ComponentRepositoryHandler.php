<?php


namespace app\core\repository\handler;


class ComponentRepositoryHandler extends BaseHandler
{

    public function getClass()
    {
        return $this->getInfo('package') . '\\' . ucfirst($this->getName());
    }
}