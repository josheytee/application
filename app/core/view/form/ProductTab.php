<?php

namespace app\core\view\form;

use app\core\view\RenderableTrait;

class ProductTab extends FormChildren
{
    use RenderableTrait;

    private $elements = [];

    public function __construct($name)
    {
        parent::__construct($name);
        $this->setTemplate('form/product_tab');
    }

    public function addElement($name, $element)
    {
        $this->elements[$name] = $element;
    }

    public function assign()
    {
        return parent::assign() + ['elements' => $this->elements];
    }

    public function render()
    {
        dump($this->elements);
        return parent::render();
    }
}