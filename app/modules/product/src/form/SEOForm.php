<?php

namespace ntc\product\form;

use app\core\controller\FormController;
use app\core\view\form\Formbuilder;

class SEOForm extends FormController {

    function title() {
        // TODO: Implement title() method.
    }

    public function build(Formbuilder $builder, $entity) {
        $builder->block(
            $builder->label('meta_title')
            , $builder->text('meta_title', '')->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('meta_keywords')
            , $builder->text('meta_keywords', '')->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('meta_description')
            , $builder->text('meta_description', '')->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('link_rewrite', 'Friendly URL')
            , $builder->text('link_rewrite', '')->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);

        $builder->block($builder->submit('save', 'Save')->addAttributes(['class' => 'btn btn-primary']))
            ->addAttributes(['class' => 'form-group']);

        return $builder;
    }
}