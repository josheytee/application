<?php

use app\core\entity\Shop;
use Phinx\Seed\AbstractSeed;

class ShopSeed extends AbstractSeed
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
            Shop::create([
                'name' => $faker->word,
                'category_id' => $faker->numberBetween(1, 100),
                'url' => $faker->url,
                'description' => $faker->text,
                'icon' => $faker->imageUrl()
            ]);
        }
    }
}
