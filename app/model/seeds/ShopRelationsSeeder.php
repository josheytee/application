<?php

use app\core\database\Seeder;

/**
 * used to seed shop relation.
 * but its must not run with other seeders so as not to cause
 * Integrity constraint violation: 1062 Duplicate entry '47-89' for key 'PRIMARY' error
 * except if know what you are doing
 * thats why its commented by default
 */
class ShopRelationsSeeder extends Seeder
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
//        for ($index = 0; $index < 500; $index++) {
//            Capsule::table('user_shop')->insert([
//                    ['id_user' => random_int(1, 201), 'id_shop' => random_int(1, 101)]
//            ]);
//        }
    }

}
