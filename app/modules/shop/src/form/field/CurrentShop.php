<?php

namespace ntc\shop\form\field;

use app\core\Context;
use app\core\view\form\FormChildren;

class CurrentShop extends FormChildren
{
    public function __construct($name)
    {
        parent::__construct($name);
        $this->setCustomTemplate(__DIR__ . '/../../..\templates\field\currentshop.tpl');
    }

    public function assign()
    {
        return parent::assign() + [
                'current_shop' => Context::service('current_user')->getCurrentShop()->id];
    }
}