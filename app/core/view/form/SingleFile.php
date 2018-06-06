<?php


namespace app\core\view\form;


class SingleFile extends FormChildren
{

    public function __construct($name)
    {
        parent::__construct($name);
        $this->setTemplate('form/single_file');
    }

}
