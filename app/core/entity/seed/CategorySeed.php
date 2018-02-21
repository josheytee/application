<?php

use app\core\entity\Category;
use Phinx\Seed\AbstractSeed;

class CategorySeed extends AbstractSeed
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
            Category::create([
                'name' => $faker->word,
                'url' => $faker->url,
                'description' => $faker->text,
                'icon' => $faker->imageUrl()
            ]);
        }
    }
}
