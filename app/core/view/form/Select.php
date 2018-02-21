<?php

namespace app\core\view\form;

use app\core\view\RenderableTrait;

class Select extends FormChildren
{
    use RenderableTrait;
    public $options = [];

    public function __construct($name)
    {
        parent::__construct($name);
        $this->setTemplate('form/select');
    }

    public function assign()
    {
        return parent::assign() + ['options' => $this->options];
    }
}