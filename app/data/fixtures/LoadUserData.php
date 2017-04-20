<?php

/**
 * Description of LoadUserData.php
 * User: adapter
 * Date: 3/21/2017
 * Time: 8:47 PM
 */
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData implements FixtureInterface {

    public function load(ObjectManager $manager) {
        $faker = Faker\Factory::create();
        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setUsername($faker->userName);
            $user->setPassword($faker->password);
            $user->setRememberToken($faker->windowsPlatformToken);
            $user->setEmail($faker->email);
            $user->setPhone($faker->phoneNumber);
            $user->setCreatedAt($faker->dateTime);
            $user->setUpdatedAt($faker->dateTime);

            $manager->persist($user);
        }
        $manager->flush();

//        for ($i = 0; $i < 100; $i++) {
//            app\model\User::create([
//            'id_current_shop' => random_int(1, 100),
//            'firstname' =>
//            'lastname' => $faker->lastName,
//            'username' => $faker->userName,
//            'password' => $faker->password,
//            'remember_token' => $faker->windowsPlatformToken,
//            'email' => $faker->email,
//            'phone' => $faker->phoneNumber
//            ]);
//        }
    }

}
