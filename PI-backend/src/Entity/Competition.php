<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CompetitionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CompetitionRepository::class)
 */
class Competition
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_Comp;

    /**
     * @ORM\Column(type="time")
     */
    private $Time_Com;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_equipe;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_place;

    /**
     * @ORM\ManyToOne(targetEntity=Terrain::class)
     */
    private $terrain;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name_comp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateComp(): ?\DateTimeInterface
    {
        return $this->date_Comp;
    }

    public function setDateComp(\DateTimeInterface $date_Comp): self
    {
        $this->date_Comp = $date_Comp;

        return $this;
    }

    public function getTimeCom(): ?\DateTimeInterface
    {
        return $this->Time_Com;
    }

    public function setTimeCom(\DateTimeInterface $Time_Com): self
    {
        $this->Time_Com = $Time_Com;

        return $this;
    }

    public function getNbEquipe(): ?int
    {
        return $this->nb_equipe;
    }

    public function setNbEquipe(int $nb_equipe): self
    {
        $this->nb_equipe = $nb_equipe;

        return $this;
    }

    public function getNbPlace(): ?int
    {
        return $this->nb_place;
    }

    public function setNbPlace(int $nb_place): self
    {
        $this->nb_place = $nb_place;

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

    public function getNameComp(): ?string
    {
        return $this->name_comp;
    }

    public function setNameComp(string $name_comp): self
    {
        $this->name_comp = $name_comp;

        return $this;
    }
}
