<?php

use app\core\entity\State;
use Phinx\Seed\AbstractSeed;

class StateSeed extends AbstractSeed
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
            State::create([
                'name' => $faker->word,
                'url' => $faker->url,
                'description' => $faker->text,
                'icon' => $faker->imageUrl()
            ]);
        }
    }
}
