<?php

use app\core\entity\Section;
use Phinx\Seed\AbstractSeed;

class SectionSeed extends AbstractSeed
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
            Section::create([
                'name' => $faker->word,
                'parent_id' => $faker->numberBetween(1, 100),
                'shop_id' => $faker->numberBetween(1, 100),
                'url' => $faker->url,
                'description' => $faker->text
            ]);
        }
    }
}
