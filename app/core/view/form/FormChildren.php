<?php

namespace app\core\view\form;


use app\core\view\RenderableTrait;

abstract class FormChildren
{
    use RenderableTrait;
    public $template = '';
    public $name;
    public $label;
    public $value;
    public $type;
    public $defaultValue;
    public $customTemplate = false;

    public function __construct($name)
    {
        $this->name = $this->label = $name;
    }

    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function setCustomTemplate($template)
    {
        $this->customTemplate = $template;
        return $this;
    }

    public function getCustomTemplate()
    {
        return $this->customTemplate;
    }

    public function assign()
    {
        return [
            'name' => $this->name,
            'label' => $this->label,
            'value' => $this->value ? $this->value : $this->defaultValue,
            'type' => $this->type
        ];
    }

    public function render()
    {
        if ($this->templateExist($this->getTemplate())) {
            return $this->renderTrait($this->assign(), $this->getTemplate());
        }
        return $this->renderCustomTrait($this->getCustomTemplate(), $this->assign());
    }
}