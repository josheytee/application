<?php


namespace ntc\component\form\field;

use app\core\Context;
use app\core\view\form\FormChildren;

class ComponentField extends FormChildren
{

    public $target;

    public function __construct($name)
    {
        parent::__construct($name);
        $this->setTemplate('form/component');
        $this->setCustomTemplate(__DIR__ . "/../../../templates/field/component.tpl");
    }

    public function assign()
    {
        return parent::assign() + [
                'components' => Context::service('component.manager')->getTargetComponents($this->target)
            ];
    }
}
