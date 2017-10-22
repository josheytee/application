<?php


namespace ntc\shop\form;


use app\core\controller\FormController;
use app\core\view\form\Formbuilder;

class ActivityForm extends FormController
{

    public function validationRules()
    {

    }

    public function build(Formbuilder $builder, $entity)
    {
        $builder->block(
            $builder->label('name')
            , $builder->text('name', $entity->getName())->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('icon')
            , $builder->text('icon', $entity->getIcon())->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);


        $builder->block(
            $builder->label('url')
            , $builder->text('url', $entity->getUrl())->addAttributes(['class' => 'form-control'])
            , $builder->help('eg. /example')
        );
        $builder->block(
            $builder->label('description')
            , $builder->textArea('description', $entity->getDescription())->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);

        $builder->block($builder->submit('Save')->addAttributes(['class' => 'btn btn-primary']))
            ->addAttributes(['class' => 'form-group']);

        return $builder;
    }

}