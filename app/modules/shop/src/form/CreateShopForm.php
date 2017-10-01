<?php

namespace ntc\shop\form;

use app\core\controller\FormController;
use app\core\entity\Activity;
use app\core\view\form\Formbuilder;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class CreateShopForm extends FormController {

    public function build(Formbuilder $builder, $entity = 0) {
        $builder->block(
            $builder->label('name')
            , $builder->text('name', $entity->getName())->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('activity')
            , $builder->select('activity', $this->activities(), $entity->getActivity()->getId())->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);

        $builder->block(
            $builder->label('state')
            , $builder->select('state', $this->states(), $entity->getState()->getId())->addAttributes(['class' => 'form-control'])
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

    private function activities() {
//        return array(
//            0 => 'Choose your main activity',
//            1 => 'Lingerie and Adult',
//            2 => 'Animals and Pets',
//            3 => 'Art and Culture',
//            4 => 'Babies',
//            5 => 'Beauty and Personal Care',
//            6 => 'Cars',
//            7 => 'Computer Hardware and Software',
//            8 => 'Download',
//            9 => 'Fashion and accessories',
//            10 => 'Flowers, Gifts and Crafts',
//            11 => 'Food and beverage',
//            12 => 'HiFi, Photo and Video',
//            13 => 'Home and Garden',
//            14 => 'Home Appliances',
//            15 => 'Jewelry',
//            16 => 'Mobile and Telecom',
//            17 => 'Services',
//            18 => 'Shoes and accessories',
//            19 => 'Sports and Entertainment',
//            20 => 'Travel',
//        );
        return $this->doctrine()->getRepository(Activity::class)->getActivities();
    }

    private function states() {
        return ['choose your state', 'oyo', 'abuja'];
    }

    public function formID() {

        return "createShop";
    }

    function getDependencies() {

        return [
            'activity | id' => 'app\core\entity\Activity',
            'state' => 'app\core\entity\State'
        ];
    }

    public function title() {

    }

}
