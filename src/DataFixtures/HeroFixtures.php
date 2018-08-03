<?php

namespace App\DataFixtures;

use App\Entity\Hero;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class HeroFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $heroes = [
            'D.Va',
            'Reinhardt',
            'Roadhog',
            'Winston',
            'Zarya',
            'Bastion',
            'Genji',
            'Hanzo',
            'Junkrat',
            'McCree',
            'Mei',
            'Pharah',
            'Reaper',
            'Soldier: 76',
            'Symmetra',
            'Torbjörn',
            'Tracer',
            'Widowmaker',
            'Lúcio',
            'Mercy',
            'Zenyatta',
            'Ana',
            'Sombra',
            'Orisa',
            'Doomfist',
            'Moira',
            'Brigitte',
            'Wrecking Ball',
        ];

        foreach ($heroes as $key => $hero) {
            $heroObject = new Hero();
            $heroObject->setName($hero);
            $manager->persist($heroObject);
            $this->addReference(
                sprintf('hero.%d', $key),
                $heroObject
            );
        }

        $manager->flush();
    }
}