<?php

namespace ntc\product\form;

use app\core\controller\FormController;
use app\core\entity_doctrine\Section;
use app\core\view\form\Formbuilder;

class AssociationForm extends FormController
{

    function title()
    {
        // TODO: Implement title() method.
    }

    public function build(Formbuilder $builder, $entity)
    {
        $builder->block(
            $builder->label('section', 'Associated Sections')
            , $builder->select('section', $this->getSections(), $entity->getSection()->getId())->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);

//        $builder->block(
//            $builder->label('cat')
//            , $builder->text('cat', '')->addAttributes(['class' => 'form-control'])
//        )->addAttributes(['class' => 'form-group']);


        $builder->block($builder->submit('save', 'Save')->addAttributes(['class' => 'btn btn-primary']))
            ->addAttributes(['class' => 'form-group']);

        return $builder;
    }

    public function getSections()
    {
        $doctrine = $this->doctrine();
        $sections = $doctrine->getRepository(Section::class)->getShopSections(1);
//        dump($sections);
        return $sections;
    }

    function getDependencies()
    {
        return [Section::class];
    }

    public function validationRules()
    {
        // TODO: Implement validationRules() method.
    }
}