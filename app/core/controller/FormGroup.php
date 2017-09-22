<?php

namespace app\core\controller;


use app\core\http\Request;
use app\core\view\form\Formbuilder;
use app\core\view\Renderabletrait;

abstract class FormGroup {
    use Renderabletrait;

    protected $form_template = 'form/form_group';

    abstract function definition();

    public function create(Request $request, Formbuilder $builder, $entity = 0) {
        foreach ($this->definition() as $id => $form) {
            $forms[$id] = $form->create($request, $builder, $entity);
        }
        $return['content'] = $this->rendertrait(['forms' => $forms], $this->form_template);
        return $return;
    }

    public function update(Request $request, Formbuilder $builder, $entity = 0) {
        foreach ($this->definition() as $id => $form) {
            $forms[$id] = $form->update($request, $builder, $entity);
        }
        $return['content'] = $this->rendertrait(['forms' => $forms], $this->form_template);
        return $return;
    }

    public function delete(Request $request, Formbuilder $builder, $entity = 0) {
        foreach ($this->definition() as $id => $form) {
            $forms[$id] = $form->delete($request, $builder, $entity);
            break;
        }
        $return['content'] = $this->rendertrait(['forms' => $forms], $this->form_template);
        return $return;
    }

    public function add(Request $request, Formbuilder $builder) {
        foreach ($this->definition() as $id => $form) {
            $forms[$id] = $form->add($request, $builder);
        }
        $return['content'] = $this->rendertrait(['forms' => $forms], $this->form_template);
        return $return;
    }
}