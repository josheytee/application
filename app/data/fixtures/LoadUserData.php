<?php

/**
 * Description of LoadUserData.php
 * User: adapter
 * Date: 3/21/2017
 * Time: 8:47 PM
 */
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use model\User;

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
      $user->setCreated($faker->dateTime);
      $user->setUpdated($faker->dateTime);

      $manager->persist($user);
    }
    $manager->flush();
    $manager->clear();
  }

}
