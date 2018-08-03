<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SeasonFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $seasons = [
            10,
            11,
        ];

        foreach ($seasons as $key => &$season) {
            $seasonObject = new Season();
            $seasonObject->setNumber($season);
            $manager->persist($seasonObject);
            $this->addReference(
                sprintf('season.%d', $key),
                $seasonObject
            );
        }

        $manager->flush();
    }
}