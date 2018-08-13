<?php

namespace ntc\administrator\controller;

use app\core\controller\ControllerBase;
use app\core\entity\Category;
use app\core\entity\Product;
use app\core\entity\ProductImage;
use app\core\entity\Section;
use app\core\entity\Shop;
use app\core\template\SmartyTemplateEngine;
use Faker\Factory;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of AdminController
 *
 * @author adapter
 */
class AdminController extends ControllerBase
{

    protected $smarty;

    public function __construct(SmartyTemplateEngine $temp)
    {
        $this->smarty = $temp;
    }

    public static function inject(ContainerInterface $container)
    {
        return new static($container->get('smarty'));
    }

    public function hello()
    {
        return $this->renderCustom(__DIR__ . '/../../templates/testing.tpl', ['c' => 'welcome to the admin page']);
    }

    public function seed()
    {
        $faker = Factory::create('en');
        //shop
        for ($i = 0; $i < 100; $i++) {

//            Category::create([
//                'name' => $faker->word,
//                'description' => $faker->sentence,
//                'icon' => $faker->url,
//            ]);
//            Shop::create([
//                'category_id' => rand(1, $i),
//                'name' => $faker->word,
//                'description' => $faker->paragraphs(20,true),
//                'url' => $faker->slug,
//                'theme' => 'ntc\genesis'
//            ]);
//            Section::create([
//                'shop_id' => rand(1, 100),
//                'name' => $faker->word,
//                'description' => $faker->paragraphs(20, true),
//                'url' => $faker->slug,
//                'parent_id' => rand(1, $i)
//            ]);
//            Product::create([
//                'shop_id' => rand(1, 100),
//                'section_id' => rand(1, 100),
//                'name' => $faker->word,
//                'description' => $faker->paragraphs(20, true),
//                'price' => $faker->numerify('#####.##'),
//                'condition' => $faker->randomElement(['new', 'used', 'refurbished']),
//                'type' => $faker->randomElement(['simple', 'virtual', 'pack']),
//                'availability' => $faker->boolean,
//                'meta_title' => $faker->words(3, true),
//                'meta_description' => $faker->words(20, true),
//                'meta_keywords' => $faker->words(20, true),
//                'link_rewrite' => $faker->slug,
//                'quantity' => $faker->randomDigitNotNull,
//                'quantity' => $faker->randomDigitNotNull,
//                'quantity_discount' => $faker->randomDigitNotNull,
//                'minimal_quantity' => $faker->randomDigitNotNull,
//                'active' => $faker->boolean,
//            ]);
//            ProductImage::create([
//                'name' => '1525001070.jpeg',
//                'path' => '/application/app/modules/product/uploads/5/1524870435.jpeg',
//                'size' => '10546.00',
//                'mimeType' => 'image/jpeg',
//                'product_id' => rand(100, 147),
//                'type' => 'cover'
//            ]);
        }

    }

    function title()
    {
        // TODO: Implement title() method.
    }
}
