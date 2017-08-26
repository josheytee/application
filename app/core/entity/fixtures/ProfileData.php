<?php
namespace app\core\entity\fixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use app\core\entity\Profile;
use Faker;
/**
 * Description of ShopData
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ProfileData implements FixtureInterface,DependentFixtureInterface {

  public function load(ObjectManager $manager) {
    $faker = Faker\Factory::create();
    for ($i = 1; $i <= 10; $i++) {
      $role = $manager->getRepository('app\core\entity\Role')->findAll();
      $profile = new Profile();
      $profile->setName($faker->name);
      $profile->addRole($role);
      $profile->setCreated($faker->dateTime);
      $profile->setUpdated($faker->dateTime);

      $manager->persist($profile);
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
       return ['app\core\entity\fixtures\RoleData'];
    }
}
