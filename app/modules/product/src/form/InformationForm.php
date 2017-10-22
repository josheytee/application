<?php

namespace ntc\product\form;


use app\core\controller\FormController;
use app\core\view\form\Formbuilder;

class InformationForm extends FormController
{

    function title()
    {
        // TODO: Implement title() method.
    }

    function getDependencies()
    {
    }

    public function build(Formbuilder $builder, $entity)
    {
//    dump($entity->getAvailable());
        $builder->block(
            $builder->label('type')
            , $builder->radio('type', $this->type(), $entity->getType())
        )->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('name')
            , $builder->text('name', $entity->getName())->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('condition')
            , $builder->select('condition', $this->condition(), $entity->getCondition())->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);

//    $builder->block(
//      $builder->label('available', 'Available for order')
//      , $builder->checkbox('available', '', $entity->getAvailable())
//    )->addAttributes(['class' => 'form-group']);
//
//    $builder->block(
//      $builder->label('show_price')
//      , $builder->checkbox('show_price', null, $entity->getShowPrice())
//    )->addAttributes(['class' => 'form-group']);
//
//    $builder->block(
//      $builder->label('online_only')
//      , $builder->checkbox('online_only', null, $entity->getOnlineOnly())
//    )->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('options')
            , $builder->checkbox('options', $this->getOptions(), $entity->getOnlineOnly())
        )->addAttributes(['class' => 'form-group']);

//        $builder->block(
//            $builder->label('location')
//            , $builder->text('location', '')->addAttributes(['class' => 'form-control'])
//        )->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('short_description')
            , $builder->textArea('short_description', $entity->getShortDescription())->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('description')
            , $builder->textArea('description', $entity->getDescription())->addAttributes(['class' => 'form-control', 'rows' => 5])
        )->addAttributes(['class' => 'form-group']);


        $builder->block($builder->submit('save', 'Save')->addAttributes(['class' => 'btn btn-primary']))
            ->addAttributes(['class' => 'form-group']);
        return $builder;
    }

    public function type()
    {
        return ['simple' => 'simple', 'pack' => 'pack', 'virtual' => 'virtual'];
    }

    public function condition()
    {
        return ['new' => 'new', 'used' => 'used', 'refurbished' => 'refurbished'];
    }

    public function getOptions()
    {
        return [
            'available' => 'available',
            'show_price' => 'Show Price',
            'online_only' => 'online_only'
        ];
    }

    public function validationRules()
    {
        return ['name' => 'required'];
    }
}