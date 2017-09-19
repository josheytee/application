<?php

namespace ntc\product\form;


use app\core\entity\controller\EntityFormController;
use app\core\entity\Product;
use app\core\view\form\Formbuilder;

class InformationForm extends EntityFormController {

    function title() {
        // TODO: Implement title() method.
    }

    function model() {
        return Product::class;
    }

    public function build(Formbuilder $builder, $entity) {
        $builder->block(
            $builder->label('type')
            , $builder->radio('type', $this->type())
        )->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('name')
            , $builder->text('name', '')->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('condition')
            , $builder->select('condition', $this->condition())->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('available','Available for order')
            , $builder->checkbox('available','')
        )->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('price','Show Price')
            , $builder->checkbox('price','')
        )->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('online', 'Online Only')
            , $builder->checkbox('online', '')
        )->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('location')
            , $builder->text('location', '')->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('short','Short Description')
            , $builder->textArea('short_description', '')->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);

 $builder->block(
            $builder->label('long','Long Description')
            , $builder->textArea('long_description', '')->addAttributes(['class' => 'form-control','rows'=>5])
        )->addAttributes(['class' => 'form-group']);


        $builder->block($builder->submit('save', 'Save')->addAttributes(['class' => 'btn btn-primary']))
            ->addAttributes(['class' => 'form-group']);
        return $builder;
    }

    public function type() {
        return ['simple', 'pack', 'virtual'];
    }
    public function condition() {
        return ['new', 'used', 'refurbished'];
    }
}