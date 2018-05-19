<?php

namespace ntc\shop\form;

use app\core\controller\FormController;
use app\core\entity\Activity;
use app\core\entity\Category;
use app\core\http\UploadedFile;
use app\core\view\form\Formbuilder;
use app\core\view\form\Select;
use app\core\view\form\Submit;
use app\core\view\form\Text;
use app\core\view\form\TextArea;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class
CreateShopForm extends FormController
{

    public function build(Formbuilder $builder)
    {
        $builder->add('name', Text::class);
        $builder->add('category_id', Select::class, function ($category) {
            $category->options = $this->activities();
            $category->label='category';

        });
        $builder->add('state', Select::class, function ($condition) {
            $condition->options = [
                'new' => 'New',
                'used' => 'Used',
                'refurbished' => 'Refurbished.'
            ];
        });
        $builder->add('url', Text::class);
        $builder->add('description', TextArea::class);
        $builder->add('create', Submit::class);


        return $builder;
    }

    private function activities()
    {
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
//        return Category::all();
    }

    private function states()
    {
        return ['choose your state', 'oyo', 'abuja'];
    }

    public function validationRules()
    {
        return [
            'name' => "alpha|required|max:128",
            'activity' => 'required',
            'state' => 'required',
            'url' => 'required',
            'description' => 'required',
        ];
    }

    public function formID()
    {

        return "createShop";
    }

    function getDependencies()
    {

        return [
            'activity | id' => 'app\core\entity\Activity',
            'state' => 'app\core\entity\State'
        ];
    }

    public function title()
    {
        return 'Shop form';
    }


    function handleFile($entity, UploadedFile $file)
    {
        // TODO: Implement handleFile() method.
    }
}
