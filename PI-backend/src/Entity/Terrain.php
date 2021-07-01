<?php

namespace App\Entity;

use App\Repository\TerrainRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
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
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $addresse;

    /**
     * @ORM\Column(type="time")
     */
    private $H_ouvert;

    /**
     * @ORM\Column(type="time")
     */
    private $H_fermeture;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\OneToMany(targetEntity=region::class, mappedBy="terrain", orphanRemoval=true)
     */
    private $Ter_reg;

    /**
     * @ORM\OneToMany(targetEntity=ReservationTerrain::class, mappedBy="terrain", orphanRemoval=true)
     */
    private $Ter_res;

    public function __construct()
    {
        $this->Ter_reg = new ArrayCollection();
        $this->Ter_res = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAddresse(): ?string
    {
        return $this->addresse;
    }

    public function setAddresse(string $addresse): self
    {
        $this->addresse = $addresse;

        return $this;
    }

    public function getHOuvert(): ?\DateTimeInterface
    {
        return $this->H_ouvert;
    }

    public function setHOuvert(\DateTimeInterface $H_ouvert): self
    {
        $this->H_ouvert = $H_ouvert;

        return $this;
    }

    public function getHFermeture(): ?\DateTimeInterface
    {
        return $this->H_fermeture;
    }

    public function setHFermeture(\DateTimeInterface $H_fermeture): self
    {
        $this->H_fermeture = $H_fermeture;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }


    /**
     * @return Collection|region[]
     */
    public function getTerReg(): Collection
    {
        return $this->Ter_reg;
    }

    public function addTerReg(region $terReg): self
    {
        if (!$this->Ter_reg->contains($terReg)) {
            $this->Ter_reg[] = $terReg;
            $terReg->setTerrain($this);
        }

        return $this;
    }

    public function removeTerReg(region $terReg): self
    {
        if ($this->Ter_reg->removeElement($terReg)) {
            // set the owning side to null (unless already changed)
            if ($terReg->getTerrain() === $this) {
                $terReg->setTerrain(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ReservationTerrain[]
     */
    public function getTerRes(): Collection
    {
        return $this->Ter_res;
    }

    public function addTerRe(ReservationTerrain $terRe): self
    {
        if (!$this->Ter_res->contains($terRe)) {
            $this->Ter_res[] = $terRe;
            $terRe->setTerrain($this);
        }

        return $this;
    }

    public function removeTerRe(ReservationTerrain $terRe): self
    {
        if ($this->Ter_res->removeElement($terRe)) {
            // set the owning side to null (unless already changed)
            if ($terRe->getTerrain() === $this) {
                $terRe->setTerrain(null);
            }
        }

        return $this;
    }
}
