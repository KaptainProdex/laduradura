<?php

namespace App\DataFixtures;

use App\Entity\Map;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MapFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $maps = [
            'Hanamura',
            'Horizon Lunar Colony',
            'Temple of Anubis',
            'Volskaya Industries',
            'Dorado',
            'Junkertown',
            'Rialto',
            'Route 66',
            'Watchpoint: Gibraltar',
            'Blizzard World',
            'Eichenwalde',
            'Hollywood',
            'King\'s Row',
            'Numbani',
            'Ilios',
            'Lijiang Tower',
            'Nepal',
            'Oasis',
        ];

        foreach ($maps as $key => $map) {
            $mapObject = new Map();
            $mapObject->setName($map);
            $manager->persist($mapObject);
            $this->addReference(
                sprintf('map.%d', $key),
                $mapObject
            );
        }

        $manager->flush();
    }
}