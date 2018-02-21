<?php

namespace app\core\view\form;


class FormBuilder
{
    protected $children = [];
    protected $bag;
    protected $form;

    public function __construct()
    {
        $this->form = Form::class;
    }

    function instantiate($child, $param)
    {
        if (is_object($child) && $child instanceof FormChildren) {
            return $child;
        }
        return new $child($param);
    }

    public function add($name, $child, $callback = null)
    {
        $this->children[$name] = $this->instantiate($child, $name);
        if (is_callable($callback)) {
            call_user_func($callback, $this->children[$name]);
        }
    }

    public function addSubmit($label)
    {
        $this->add('', Submit::class, function ($submit) use ($label) {
            $submit->label = $label;
        });
    }

    public function remove($name)
    {
        unset($this->children[$name]);
    }

    public function setFormBag($bag)
    {
        $this->bag = $bag;
        return $this;
    }

    public function setForm($form)
    {
        $this->form = $form;
        return $this;
    }

    public function render()
    {
        $formClass = $this->form;
        $form = new $formClass($this->bag);
        foreach ($this->children as $name => $child) {
            $form->addChildren($name, $child);
        }
        return $form->render();
    }
}