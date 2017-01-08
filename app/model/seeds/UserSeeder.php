<?php

use Phinx\Seed\AbstractSeed;
use app\core\database\Seeder;

class UserSeeder extends Seeder {

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
        for ($i = 0; $i < 100; $i++) {
            app\model\User::create([
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'username' => $faker->userName,
                'password' => $faker->password,
                'remember_token' => $faker->windowsPlatformToken,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber
            ]);
        }
    }

}
