<?php

namespace App\Entity;

use App\Repository\CompetitionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
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
     * @ORM\Column(type="datetime")
     */
    private $date_com;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbequipe;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbplacedispo;

    /**
     * @ORM\OneToOne(targetEntity=terrain::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Comp_ter;

    /**
     * @ORM\OneToOne(targetEntity=reservationCompetition::class, cascade={"persist", "remove"})
     */
    private $res_comp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCom(): ?\DateTimeInterface
    {
        return $this->date_com;
    }

    public function setDateCom(\DateTimeInterface $date_com): self
    {
        $this->date_com = $date_com;

        return $this;
    }

    public function getNbequipe(): ?int
    {
        return $this->nbequipe;
    }

    public function setNbequipe(int $nbequipe): self
    {
        $this->nbequipe = $nbequipe;

        return $this;
    }

    public function getNbplacedispo(): ?int
    {
        return $this->nbplacedispo;
    }

    public function setNbplacedispo(int $nbplacedispo): self
    {
        $this->nbplacedispo = $nbplacedispo;

        return $this;
    }

    public function getCompTer(): ?terrain
    {
        return $this->Comp_ter;
    }

    public function setCompTer(terrain $Comp_ter): self
    {
        $this->Comp_ter = $Comp_ter;

        return $this;
    }

    public function getResComp(): ?reservationCompetition
    {
        return $this->res_comp;
    }

    public function setResComp(?reservationCompetition $res_comp): self
    {
        $this->res_comp = $res_comp;

        return $this;
    }
}
