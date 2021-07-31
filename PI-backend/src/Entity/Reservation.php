<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\GetResUserController;
use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Api\FilterInterface;

/**
 *@ORM\Table()
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 * @ApiResource(attributes={"denormalizationContext" = {"groups"={"get_perso"}}})
 * @ApiResource(attributes={"normalizationContext" ={"groups"={"terrain"}}})
 *@ApiFilter(SearchFilter::class,properties={"personne_id":"exact"})
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Groups({"terrain"})
     */
    private $date_reservation;

    /**
     * @ORM\Column(type="time")
     *  @Groups({"terrain"})
     */
    private $time;

    /**
     * @ORM\ManyToOne(targetEntity=Terrain::class, inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     *   @Groups({"terrain"})
     */
    private $terrain;

    /**
     * @ORM\ManyToOne(targetEntity=Personne::class ,inversedBy="reservations")
     *  @Groups("person")
     * @ORM\JoinColumn(nullable=false)
     *
     *@Groups({"get_perso"})
     */
    private $personne_id;

    #  /**
    #  * @ORM\ManyToOne(targetEntity=terrain::class)
    #   * @ORM\JoinColumn(name="name_terrain", referencedColumnName="Nom"))
    #   */
    #  private $name_terrain;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->date_reservation;
    }

    public function setDateReservation(
        \DateTimeInterface $date_reservation
    ): self {
        $this->date_reservation = $date_reservation;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

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

    public function getPersonneId(): ?personne
    {
        return $this->personne_id;
    }

    public function setPersonneId(?personne $personne_id): self
    {
        $this->personne_id = $personne_id;

        return $this;
    }
}
