<?php
declare(strict_types=1);

namespace App\Dto\Form;

use App\Entity\Hero;
use App\Entity\Map;
use App\Entity\Match;
use App\Entity\Season;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @var int|null
     */
    private $seasonRank;

    /**
     * @return Hero[]
     */
    public function getHeroes(): ?Collection
    {
        return $this->heroes;
    }

    public function setHeroes(?Collection $heroes): void
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

    /**
     * @return int|null
     */
    public function getSeasonRank(): ?int
    {
        return $this->seasonRank;
    }

    /**
     * @param int|null $seasonRank
     */
    public function setSeasonRank(?int $seasonRank): void
    {
        $this->seasonRank = $seasonRank;
    }



    public function createMatch(): Match
    {
        $match = new Match();

        !$this->heroes ?: $match->setHeroes($this->heroes);
        !$this->season ?: $match->setSeason($this->season);
        !$this->map ?: $match->setMap($this->map);
        $match->setSeasonRank($this->seasonRank);

        return $match;
    }

    public function updateMatch(Match $match): Match
    {
        !$this->heroes ?: $match->setHeroes($this->heroes);
        !$this->season ?: $match->setSeason($this->season);
        !$this->map ?: $match->setMap($this->map);
        $match->setSeasonRank($this->seasonRank);

        return $match;
    }

    public static function fromMatch(Match $match): self
    {
        $matchDto = new MatchDto();

        !$match->getHeroes() ?: $matchDto->setHeroes($match->getHeroes());
        !$match->getSeason() ?: $matchDto->setSeason($match->getSeason());
        !$match->getMap() ?: $matchDto->setMap($match->getMap());
        $matchDto->setSeasonRank($match->getSeasonRank());

        return $matchDto;
    }
}
