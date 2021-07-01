<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RegionRepository::class)
 */
class Region
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $government;

    /**
     * @ORM\ManyToOne(targetEntity=Terrain::class, inversedBy="Ter_reg")
     * @ORM\JoinColumn(nullable=false)
     */
    private $terrain;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGovernment(): ?string
    {
        return $this->government;
    }

    public function setGovernment(string $government): self
    {
        $this->government = $government;

        return $this;
    }

    public function getTerrain(): ?Terrain
    {
        return $this->terrain;
    }

    public function setTerrain(?Terrain $terrain): self
    {
        $this->terrain = $terrain;

        return $this;
    }
}
