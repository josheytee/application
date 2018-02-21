<?php

namespace app\core\view\form;

use app\core\view\RenderableTrait;

class Checkbox extends FormChildren
{
    use RenderableTrait;
    public $checks = [];

    public function __construct($name)
    {
        parent::__construct($name);
        $this->setTemplate('form/checkbox');
    }

    public function assign()
    {
        return parent::assign() + $this->checks();
    }

    public function checks()
    {
        if (empty($this->checks)) {
            return ['checks' => [$this->name]];
        }
        return ['checks' => $this->checks];
    }
}