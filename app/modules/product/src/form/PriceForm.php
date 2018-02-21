<?php

namespace ntc\product\form;


use app\core\controller\FormController;
use app\core\entity_doctrine\Product;
use app\core\view\form\Formbuilder;

class PriceForm extends FormController
{

    function title()
    {
        // TODO: Implement title() method.
    }

    function model()
    {
        return Product::class;
    }

    public function build(Formbuilder $builder, $entity)
    {

        $builder->block(
            $builder->label('price')
            , $builder->text('price', '')->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('wholesale_price')
            , $builder->text('wholesale_price', '')->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);


        $builder->block($builder->submit('save', 'Save')->addAttributes(['class' => 'btn btn-primary']))
            ->addAttributes(['class' => 'form-group']);

        return $builder;


    }

    public function validationRules()
    {
        // TODO: Implement validationRules() method.
    }
}