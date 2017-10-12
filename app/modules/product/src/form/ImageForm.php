<?php

namespace ntc\product\form;


use app\core\controller\FormController;
use app\core\entity\Product;
use app\core\view\form\Formbuilder;

class ImageForm extends FormController {

    function title() {
        // TODO: Implement title() method.
    }

    function model() {
        return Product::class;
    }

    public function build(Formbuilder $builder, $entity) {
        $this->uploadForm($builder);

//        $builder->block(
//          $builder->label('images')
//          , $builder->file('images', '')->addAttributes(['class' => 'form-control'])
//        )->addAttributes(['class' => 'form-group']);
//
//        $builder->block($builder->submit('save', 'Save')->addAttributes(['class' => 'btn btn-primary']))
//          ->addAttributes(['class' => 'form-group']);

        return $builder;
    }

    public function uploadForm(Formbuilder $builder) {

        $builder->block(
          $builder->label('upload')
          , $builder->file('upload', '')->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);

        $builder->block($builder->submit('upload-image', 'Upload Image')->addAttributes(['class' => 'btn btn-primary']))
          ->addAttributes(['class' => 'form-group']);

        return $builder->fetch();
    }

    public function validationRules() {
        // TODO: Implement validationRules() method.
    }
}