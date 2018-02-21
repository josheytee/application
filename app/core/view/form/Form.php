<?php

namespace app\core\view\form;

use app\core\view\RenderableTrait;

class Form
{
    use RenderableTrait;
    protected $template = 'form/form';
    protected $form_body = [];
    /**
     * @var FormBag
     */
    private $bag;

    public function __construct(FormBag $bag)
    {
        $this->bag = $bag;
    }

    public function addChildren($name, FormChildren $child)
    {
        $this->children[$name] = $child;
    }

    public function render()
    {
        $form_body = '';
        foreach ($this->children as $name => $child) {
            if ($this->bag->has($name)) {
                $child->value = $this->bag->get($name);
            }
            $form_body .= $child->render();
        }
        return $this->renderTrait(
            [
                'method' => 'post',
                'form_body' => $form_body
            ], $this->template);
    }
}