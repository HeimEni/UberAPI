<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TaxiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaxiRepository::class)]
#[ApiResource(
    paginationEnabled: false,
)]
class Taxi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $totalKm = null;

    #[ORM\ManyToOne(inversedBy: 'taxis')]
    private ?driver $driver = null;

    #[ORM\ManyToOne(inversedBy: 'taxis')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CarModel $CarModel = null;

    /**
     * @var Collection<int, ride>
     */
    #[ORM\OneToMany(targetEntity: Ride::class, mappedBy: 'taxi')]
    private Collection $Rides;

    public function __construct()
    {
        $this->Rides = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalKm(): ?int
    {
        return $this->totalKm;
    }

    public function setTotalKm(int $totalKm): static
    {
        $this->totalKm = $totalKm;

        return $this;
    }

    public function getDriver(): ?driver
    {
        return $this->driver;
    }

    public function setDriver(?driver $driver): static
    {
        $this->driver = $driver;

        return $this;
    }

    public function getCarModel(): ?CarModel
    {
        return $this->CarModel;
    }

    public function setCarModel(?CarModel $carModel): static
    {
        $this->CarModel = $carModel;
        return $this;
    }

    /**
     * @return Collection<int, ride>
     */
    public function getRides(): Collection
    {
        return $this->Rides;
    }

    public function addRide(ride $ride): static
    {
        if (!$this->Rides->contains($ride)) {
            $this->Rides->add($ride);
            $ride->setTaxi($this);
        }

        return $this;
    }

    public function removeRide(ride $ride): static
    {
        if ($this->Rides->removeElement($ride)) {
            // set the owning side to null (unless already changed)
            if ($ride->getTaxi() === $this) {
                $ride->setTaxi(null);
            }
        }

        return $this;
    }
}
