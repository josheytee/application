<?php

namespace app\core\view\form;

use app\core\view\RenderableTrait;

class Radio extends FormChildren
{
    use RenderableTrait;
    public $radios = [];

    public function __construct($name)
    {
        parent::__construct($name);
        $this->setTemplate('form/radio');
    }

    public function assign()
    {
        return parent::assign() + ['radios' => $this->radios];
    }
}
