<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`match`")
 * @ORM\Entity(repositoryClass="App\Repository\MatchRepository")
 */
class Match
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Hero", inversedBy="matches")
     */
    private $heroes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Season", inversedBy="matches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $season;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Map", inversedBy="matches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $map;

    public function __construct()
    {
        $this->heroes = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setHeroes(ArrayCollection $heroes): void
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
            $this->heroes[] = $hero;
        }

        return $this;
    }

    public function removeHero(Hero $hero): self
    {
        if ($this->heroes->contains($hero)) {
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
}
