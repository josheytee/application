<?php

namespace ntc\account\form\field;

use app\core\view\form\FormChildren;

class RolePermissions extends FormChildren
{
    public $repo;

    public function __construct($name)
    {
        parent::__construct($name);
        $this->setCustomTemplate(__DIR__ . '/../../..\templates\field\role_permissions.tpl');
    }

    public function assign()
    {
        return parent::assign() + ['repo' => $this->repo];
    }
}