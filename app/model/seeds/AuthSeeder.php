<?php

use app\core\database\Seeder;

class AuthSeeder extends Seeder {

    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run() {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 10; $i++) {
            app\model\Auth::create([
                'id_user' => $faker->randomDigitNotNull,
                'duration' => $faker->randomDigitNotNull,
                'secret' => $faker->sha256
            ]);
        }
    }

}
