<?php

namespace ntc\product\form;

use app\core\controller\FormController;
use app\core\entity\Section;
use app\core\view\form\Formbuilder;

class AssociationForm extends FormController {

    function title() {
        // TODO: Implement title() method.
    }

    public function build(Formbuilder $builder, $entity) {
        $builder->block(
            $builder->label('section', 'Associated Sections')
            , $builder->text('section', '')->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('cat')
            , $builder->text('cat', '')->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);


        $builder->block($builder->submit('save', 'Save')->addAttributes(['class' => 'btn btn-primary']))
            ->addAttributes(['class' => 'form-group']);

        return $builder;
    }

    function getDependencies() {
        return [Section::class];
    }
}