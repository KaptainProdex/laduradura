<?php
declare(strict_types=1);
namespace App\Dto\Form;

use App\Entity\Hero;
use App\Entity\Map;
use App\Entity\Match;
use App\Entity\Season;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class MatchDto
{
    /**
     * @var Hero[]|ArrayCollection
     * @Assert\Count(min="1")
     */
    private $heroes;

    /**
     * @var Season
     * @Assert\NotNull()
     */
    private $season;

    /**
     * @var Map
     * @Assert\NotNull()
     */
    private $map;

    /**
     * @return Hero[]
     */
    public function getHeroes(): ?ArrayCollection
    {
        return $this->heroes;
    }

    public function setHeroes(?ArrayCollection $heroes): void
    {
        $this->heroes = $heroes;
    }

    public function getSeason(): ?Season
    {
        return $this->season;
    }

    public function setSeason(?Season $season): void
    {
        $this->season = $season;
    }

    public function getMap(): ?Map
    {
        return $this->map;
    }

    public function setMap(?Map $map): void
    {
        $this->map = $map;
    }

    public function createMatch(): Match
    {
        $match = new Match();

        !$this->heroes ?: $match->setHeroes($this->heroes);
        !$this->season ?: $match->setSeason($this->season);
        !$this->map ?: $match->setMap($this->map);

        return $match;
    }
}
