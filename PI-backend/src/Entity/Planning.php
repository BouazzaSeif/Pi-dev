<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PlanningRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=PlanningRepository::class)
 */
class Planning
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
    private $date_Plan;

    /**
     * @ORM\Column(type="time")
     */
    private $time_Plan;

    /**
     * @ORM\ManyToOne(targetEntity=Terrain::class, inversedBy="plannings")
     */
    private $terrain;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatePlan(): ?\DateTimeInterface
    {
        return $this->date_Plan;
    }

    public function setDatePlan(\DateTimeInterface $date_Plan): self
    {
        $this->date_Plan = $date_Plan;

        return $this;
    }

    public function getTimePlan(): ?\DateTimeInterface
    {
        return $this->time_Plan;
    }

    public function setTimePlan(\DateTimeInterface $time_Plan): self
    {
        $this->time_Plan = $time_Plan;

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
