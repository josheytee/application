<?php
namespace app\core\entity\fixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use app\core\entity\Product;


use Faker;
/**
 * Description of ProductData
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class ProductData implements FixtureInterface ,DependentFixtureInterface{

  public function load(ObjectManager $manager) {
    $faker = Faker\Factory::create();
    for ($i = 1; $i <= 10; $i++) {
        $shop = $manager->getRepository('app\core\entity\Shop')->findAll();
        $section = $manager->getRepository('app\core\entity\Section')->findAll();

      $product = new Product();
      $product->setName($faker->name);
      $product->setActive(rand(0, 1));
      $product->setAvailableForOrder($faker->boolean());
      $product->setCondition($faker->randomElement(['new', 'refurbished', 'used']));
      $product->setDescription($faker->paragraphs);
      $product->setOnlineOnly($faker->boolean());
      $product->setPrice($faker->numerify('######.####'));
      $product->setSection($section);
      $product->setShop($shop);
      $product->setShortDescription($faker->paragraph);
      $product->setShowPrice($faker->boolean());
      $product->setType($faker->randomElement(['pack', 'simple', 'virtual']));
      $product->setCreated($faker->dateTime);
      $product->setUpdated($faker->dateTime);

      $manager->persist($product);
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
        return ['app\core\entity\fixtures\ShopData','app\core\entity\fixtures\SectionData'];
    }
}
