<?php

namespace app\core\controller;


use app\core\http\Request;
use app\core\view\form\Formbuilder;
use app\core\view\RenderableTrait;

abstract class FormGroup extends FormController {
    use RenderableTrait;

    protected $form_template = 'form/form_group';

    abstract function definition();

    public function create(Request $request, Formbuilder $builder, $id = 0) {
        $errors = null;
        if (!empty($request->all())) {
            $validator = $this->validate($request->all());
            if ($validator->passes())
                $this->createEntity($request);
            else
                $errors = $this->handleValidationErrors($validator);
        }
        foreach ($this->definition() as $formId => $form) {
            $builder = new Formbuilder('form/form_group_form');
            $forms[$formId] = $form->build($builder, $this->getEntity($request, $id))->fetch();
        }
        $return['content'] = $this->renderTrait([
            'forms' => $forms,
            'attributes' => $this->formAttributes(),
            'errors' => $errors
          ]
          , $this->form_template);
        return $return;
    }

    public function update(Request $request, Formbuilder $builder, $id) {
        foreach ($this->definition() as $formId => $form) {
            $builder = new Formbuilder('form/form_group_form');
            $forms[$formId] = $form->build($builder, $this->getEntity($request, $id))->fetch();
        }
        $this->updateEntity($request, $id);
        $return['content'] = $this->renderTrait(['forms' => $forms, 'attributes' => $this->formAttributes()]
          , $this->form_template);
        return $return;
    }

    public function delete(Request $request, $id) {
        foreach ($this->definition() as $formId => $form) {
            $forms[$formId] = $form->delete($request, $id);
            break;
        }
        $return['content'] = $this->renderTrait(['forms' => $forms], $this->form_template);
        return $return;
    }

    public function add(Request $request, Formbuilder $builder) {
        foreach ($this->definition() as $id => $form) {
            $forms[$id] = $form->add($request, $builder);
        }
        $return['content'] = $this->renderTrait(['forms' => $forms], $this->form_template);
        return $return;
    }

    public function build(Formbuilder $builder, $entity) {
        // TODO: Implement build() method.
    }
}