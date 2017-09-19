<?php

namespace app\core\controller;


use app\core\http\Request;
use app\core\view\form\Formbuilder;

abstract class FormGroup {
    abstract function definition();

    public function build(Formbuilder $formbuilder) {

    }

    public function create(Request $request, Formbuilder $builder, $entity = 0) {
        foreach ($this->definition() as $id => $form) {
            if ($form->validate()) {
                $form->build($builder, 0)->fetch();
//                $this->addEntity($request);
            }
        }
//                $return['content'] = $form->build($builder, 0)->fetch();
//        return $return;
    }

    protected $form_template = 'form/form.tpl';

    public function render() {
        $form = '';
        foreach ($this->elements as $element) {
            $form .= $element->render();
        }
        return $this->rendertrait(
            [
                'attributes' => $this->getAttributes(),
                'form_body' => $form
            ], $this->form_template);
    }

    public function fetch() {
        return $this->render();
    }
}