<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;


use App\Repository\TerrainRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=TerrainRepository::class)
 */


 class Terrain
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
    private $Nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $Prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Addresse;

    /**
     * @ORM\Column(type="time")
     */
    private $H_Ferm;

    /**
     * @ORM\Column(type="time")
     */
    private $H_Ouvert;

    /**
     * @ORM\ManyToOne(targetEntity=Region::class)
     */
    private $Region;

 

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->plannings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->Prix;
    }

    public function setPrix(int $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getAddresse(): ?string
    {
        return $this->Addresse;
    }

    public function setAddresse(string $Addresse): self
    {
        $this->Addresse = $Addresse;

        return $this;
    }

    public function getHFerm(): ?\DateTimeInterface
    {
        return $this->H_Ferm;
    }

    public function setHFerm(\DateTimeInterface $H_Ferm): self
    {
        $this->H_Ferm = $H_Ferm;

        return $this;
    }

    public function getHOuvert(): ?\DateTimeInterface
    {
        return $this->H_Ouvert;
    }

    public function setHOuvert(\DateTimeInterface $H_Ouvert): self
    {
        $this->H_Ouvert = $H_Ouvert;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->Region;
    }

    public function setRegion(?Region $Region): self
    {
        $this->Region = $Region;

        return $this;
    }

   

    
}
