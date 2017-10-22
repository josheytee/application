<?php

use app\core\database\Seeder;

class ShopSectionProductSeeder extends Seeder
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
            app\model\Shop::create([
                'id_category' => $faker->randomDigitNotNull,
                'name' => $faker->word . " " . $faker->word,
                'description' => $faker->text(350),
                'url' => $faker->url
            ]);
        }
        for ($i = 0; $i < 100; $i++) {
            app\model\Section::create([
                'id_parent' => $faker->randomDigitNotNull,
                'id_shop' => $faker->randomDigitNotNull,
                'name' => $faker->word,
                'description' => $faker->text,
                'url' => $faker->url
            ]);
        }
        for ($i = 1; $i < 101; $i++) {
            app\model\Product::create([
                'id_shop' => $faker->randomDigitNotNull,
                'id_section' => $i,
                'name' => $faker->word . " " . $faker->word,
                'description' => $faker->text,
                'price' => $faker->numerify('######.##'),
                'availability' => $faker->boolean(),
            ]);
        }
    }

}
