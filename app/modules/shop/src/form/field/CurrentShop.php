<?php

namespace ntc\shop\form\field;

use app\core\view\form\FormChildren;

class CurrentShop extends FormChildren
{
    public function __construct($name)
    {
        parent::__construct($name);
        $this->setCustomTemplate(__DIR__ . '/../../..\templates\field\currentshop.tpl');
    }
}