<?php

namespace ntc\section\form;

use app\core\controller\FormController;
use app\core\entity\{
  Section, Shop
};
use app\core\view\form\FormBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * SectionForm
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class SectionForm extends FormController {

    public static function inject(ContainerInterface $container) {
        return new static();
    }


    public function build(Formbuilder $builder, $entity = 0) {
        $builder->hidden('shop', $this->currentShop(),$entity->getShop());

        $builder->block(
          $builder->label('name')
          , $builder->text('name', $entity->getName())->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);


        $builder->block(
          $builder->label('section', 'Parent')
          , $builder->select('section', $this->getSections(), $entity->getSection()->getId())->addAttributes(['class' => 'form-control'])
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

    public function formID() {
        return 'user';
    }

    public function currentShop() {
        return 1;
    }


    public function getSections() {
        $doctrine = $this->doctrine();
        $sections = $doctrine->getRepository(Section::class)->getShopSections($this->currentShop(), true);
//        dump($sections);
        return $sections;
    }

    public function getDependencies() {
        return [
          'section' => Section::class,
          'shop' => Shop::class
        ];
    }

    function title() {
        return 'section';
    }

    public function validationRules() {
        return [
          'name' => 'required'
        ];
    }
}
