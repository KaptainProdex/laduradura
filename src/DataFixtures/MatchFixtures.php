<?php

namespace App\DataFixtures;

use App\Entity\Match;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class MatchFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            HeroFixtures::class,
            MapFixtures::class,
            SeasonFixtures::class,
        ];
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i < 10; $i++) {
            $match1 = new Match();
            $match1->setMap(
                $this->getRandomReference('map')
            );
            $match1->setSeason(
                $this->getRandomReference('season')
            );

            foreach (range(1, rand(1, 3)) as $index) {
                $match1->addHero(
                    $this->getRandomReference('hero')
                );
            }

            $manager->persist($match1);
            $manager->flush();
        }

    }

    public function getRandomReference(string $prefix)
    {
        $i = 0;
        $references = [];

        while ($this->hasReference($prefix . '.' . $i)) {
            $references[] = $this->getReference($prefix . '.' . $i);
            $i++;
        }

        $rand = array_rand($references);
        return $references[$rand];
    }

}