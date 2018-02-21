<?php

namespace app\core\view\form;

use app\core\view\RenderableTrait;

class TextArea extends FormChildren
{
    use RenderableTrait;

    public function __construct($name)
    {
        parent::__construct($name);
        $this->setTemplate('form/textarea');
    }
}