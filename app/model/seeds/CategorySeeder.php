<?php

use app\core\database\Seeder;

class CategorySeeder extends Seeder
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
            app\model\Category::create([
                'name' => $faker->word,
                'description' => $faker->text,
                'icon' => $faker->imageUrl()
            ]);
        }
    }

}
