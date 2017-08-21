<?php

namespace ntc\shop\form;

use app\core\controller\FormController;
use app\core\view\form\Formbuilder;
use app\core\http\Request;

/**
 * Description of CreateShopForm
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class CreateShopForm extends FormController {

  public function build(Formbuilder $builder) {
    $builder->block(
            $builder->label('name')
            , $builder->text('name', '')->addAttributes(['class' => 'form-control'])
    )->addAttributes(['class' => 'form-group']);

    $builder->block(
            $builder->label('activity')
            , $builder->select('activity', $this->activities())->addAttributes(['class' => 'form-control'])
    )->addAttributes(['class' => 'form-group']);

    $builder->block(
            $builder->label('state')
            , $builder->select('state', $this->states())->addAttributes(['class' => 'form-control'])
    )->addAttributes(['class' => 'form-group']);

    $builder->block($builder->submit('create', 'Create')->addAttributes(['class' => 'btn btn-primary']))
            ->addAttributes(['class' => 'form-group']);
    return $builder;

    return $builder;
  }

  private function activities() {
    return array(
        0 => 'Choose your main activity',
        1 => 'Lingerie and Adult',
        2 => 'Animals and Pets',
        3 => 'Art and Culture',
        4 => 'Babies',
        5 => 'Beauty and Personal Care',
        6 => 'Cars',
        7 => 'Computer Hardware and Software',
        8 => 'Download',
        9 => 'Fashion and accessories',
        10 => 'Flowers, Gifts and Crafts',
        11 => 'Food and beverage',
        12 => 'HiFi, Photo and Video',
        13 => 'Home and Garden',
        14 => 'Home Appliances',
        15 => 'Jewelry',
        16 => 'Mobile and Telecom',
        17 => 'Services',
        18 => 'Shoes and accessories',
        19 => 'Sports and Entertainment',
        20 => 'Travel',
    );
  }

  private function states() {
    return ['choose your state', 'oyo', 'abuja'];
  }

  public function formID() {

    return "createShop";
  }

  public function process(Request $request) {
    var_dump($request->all());
  }

}
