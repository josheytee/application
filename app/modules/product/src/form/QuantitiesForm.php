<?php

namespace ntc\product\form;

use app\core\entity\controller\EntityFormController;
use app\core\view\form\Formbuilder;

class QuantitiesForm extends EntityFormController {

    function title() {
        // TODO: Implement title() method.
    }

    public function build(Formbuilder $builder, $entity) {
        $builder->block(
            $builder->label('quantity')
            , $builder->text('quantity', '')->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('minimal_quantity')
            , $builder->text('minimal_quantity', '')->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('quantity_discount')
            , $builder->text('quantity_discount', '')->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);


        $builder->block($builder->submit('save', 'Save')->addAttributes(['class' => 'btn btn-primary']))
            ->addAttributes(['class' => 'form-group']);

        return $builder;
    }
}