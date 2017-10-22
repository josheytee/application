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


class RouteData implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
//    $faker = Faker\Factory::create();
//    for ($i = 1; $i <= 10; $i++) {
//      $route = new Router();
//      $route->setName($faker->name);
//      $route->setPath($faker->url);
////      $route->setParams(serialize(['_name' => 'hello', '_controller' => 'app\admin\page\Product::create']));
////      $route->setState($faker->userName);
//      $manager->persist($route);
//    }
//    $manager->flush();
//    $manager->clear();
    }

}
