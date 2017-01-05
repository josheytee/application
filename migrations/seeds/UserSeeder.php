<?php

use Phinx\Seed\AbstractSeed;
use app\migration\Seed;

class UserSeeder extends Seed {

    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run() {
        app\model\User::create([
            'serial_number' => (int) rand(10, 100),
            'name' => str_random(10) . '@gmail.com'
        ]);
    }

}
