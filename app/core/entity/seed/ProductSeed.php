<?php

use app\core\entity\Product;
use Phinx\Seed\AbstractSeed;

class ProductSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 100; $i++) {
            Product::create([
                'name' => $faker->word,
                'section_id' => $faker->numberBetween(1, 100),
                'shop_id' => $faker->numberBetween(1, 100),
                'description' => $faker->text,
                'price' => $faker->url,
                'condition' => $faker->randomElement(['new', 'used', 'refurbished']),
                'type' => $faker->randomElement(['simple', 'virtual', 'pack']),
                'availability' => $faker->boolean,
                'meta_title' => $faker->text,
                'meta_description' => $faker->paragraph,
                'meta_keywords' => $faker->title,
                'link_rewrite' => $faker->url,
                'quantity' => $faker->randomDigit,
                'quantity_discount' => $faker->randomDigit,
                'minimal_quantity' => $faker->randomDigit,
                'active' => $faker->boolean
            ]);
        }
    }
}
