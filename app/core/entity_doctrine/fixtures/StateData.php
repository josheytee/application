<?php

namespace app\core\entity_doctrine\fixtures;

use app\core\entity_doctrine\State;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class StateData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
//        foreach ($this->data() as $key => $value) {
        for ($i = 1; $i <= 10; $i++) {
            $state = new State();
            $state->setName($value);
            $state->setUrl($faker->url);
            $state->setCreated($faker->dateTime);
            $state->setUpdated($faker->dateTime);

            $manager->persist($state);
        }
        $manager->flush();
        $this->addReference('state', $state);
    }

    public function getOrder(): int
    {
        return 4;
    }

}
