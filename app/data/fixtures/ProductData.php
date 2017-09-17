<?php

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Description of ProductData
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ProductData implements FixtureInterface {

  public function load(ObjectManager $manager) {
//    $faker = Faker\Factory::create();
//    for ($i = 1; $i <= 10; $i++) {
//
//      $product = new Product();
//      $product->setName($faker->company);
//      $product->setActive(rand(0, 1));
//      $product->setAvailableForOrder($faker->boolean());
//      $product->setCondition($faker->randomElement(['new', 'refurbished', 'used']));
//      $product->setDescription($faker->paragraphs);
//      $product->setOnlineOnly($faker->boolean());
//      $product->setPrice($faker->numerify('######.####'));
//      $product->setSection($manager->find('model\Section', $i));
//      $product->setShop($manager->find('model\Shop', $i));
//      $product->setShortDescription($faker->paragraph);
//      $product->setShowPrice($faker->boolean());
//      $product->setType($faker->randomElement(['pack', 'simple', 'virtual']));
//      $product->setCreated($faker->dateTime);
//      $product->setUpdated($faker->dateTime);
//
//      $manager->persist($product);
//    }
//    $manager->flush();
//    $manager->clear();
  }

}
