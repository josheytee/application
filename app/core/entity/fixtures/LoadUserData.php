<?php
namespace app\core\entity\fixtures;

/**
 * Description of LoadUserData.php
 * User: adapter
 * Date: 3/21/2017
 * Time: 8:47 PM
 */
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use app\core\entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class LoadUserData implements FixtureInterface ,DependentFixtureInterface{

  public function load(ObjectManager $manager) {
    $faker = Faker\Factory::create();
      $role = $manager->getRepository('app\core\entity\Role')->findAll();

      for ($i = 1; $i <= 10; $i++) {
      $user = new User();
      $user->setFirstname($faker->firstName);
      $user->setLastname($faker->lastName);
      $user->setUsername($faker->userName);
      $user->setPassword($faker->password);
      $user->setRememberToken($faker->randomKey());
      $user->setEmail($faker->email);
      $user->setPhone($faker->phoneNumber);
        $user->addRole($role);
      $user->setCreated($faker->dateTime);
      $user->setUpdated($faker->dateTime);

      $manager->persist($user);
    }
    $manager->flush();
    $manager->clear();
  }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    function getDependencies()
    {
        return ['app\core\fixtures\RoleData'];
    }
}
