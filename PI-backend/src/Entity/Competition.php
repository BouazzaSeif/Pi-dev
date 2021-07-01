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
}
