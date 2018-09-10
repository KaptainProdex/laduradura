<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Table(name="`match`")
 * @ORM\Entity(repositoryClass="App\Repository\MatchRepository")
 */
class Match implements JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Hero", inversedBy="matches")
     */
    private $heroes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Season", inversedBy="matches")
     */
    private $season;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Map", inversedBy="matches")
     */
    private $map;


    /**
     * @var int|null
     * @ORM\Column(type="integer", nullable=true)
     */
    private $seasonRank;

    public function __construct()
    {
        $this->heroes = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setHeroes(Collection $heroes): void
    {
        $this->heroes = $heroes;
    }

    /**
     * @return Collection|Hero[]
     */
    public function getHeroes(): Collection
    {
        return $this->heroes;
    }

    public function addHero(Hero $hero): self
    {
        if (!$this->heroes->contains($hero)) {
            $hero->addMatch($this);
            $this->heroes->add($hero);
        }

        return $this;
    }

    public function removeHero(Hero $hero): self
    {
        if ($this->heroes->contains($hero)) {
            $hero->removeMatch($this);
            $this->heroes->removeElement($hero);
        }

        return $this;
    }

    public function getSeason(): ?Season
    {
        return $this->season;
    }

    public function setSeason(?Season $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getMap(): ?Map
    {
        return $this->map;
    }

    public function setMap(?Map $map): self
    {
        $this->map = $map;

        return $this;
    }

    public function getSeasonRank(): ?int
    {
        return $this->seasonRank;
    }

    public function setSeasonRank(?int $seasonRank): void
    {
        $this->seasonRank = $seasonRank;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        $heroes = $this->getHeroes();
        if ($heroes instanceof Collection) {
            $heroes = $heroes->toArray();
        }

        return [
            'id' => $this->getId(),
            'season' => $this->getSeason()->getId(),
            'heroes' => array_map(function (Hero $hero) {
                return ['id' => $hero->getId()];
            }, $heroes),
            'map' => $this->getMap()->getId(),
            'season_rank' => $this->getSeasonRank()
        ];
    }
}
