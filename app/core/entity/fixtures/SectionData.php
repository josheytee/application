<?php

namespace app\core\entity\fixtures;

use app\core\entity\Section;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

/**
 * Description of SectionData
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class SectionData implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        for ($i = 1; $i <= 10; $i++) {
            $shop = $manager->find('app\core\entity\Shop', $i);
            $section = new Section();
            $section->setName($faker->company);
            $section->setShop($shop);
            $section->setDescription($faker->paragraphs);
            $section->setUrl($faker->url);
            $section->setCreated($faker->dateTime);
            $section->setUpdated($faker->dateTime);

            $manager->persist($section);
        }
        $manager->flush();
        $manager->clear();
    }

}
