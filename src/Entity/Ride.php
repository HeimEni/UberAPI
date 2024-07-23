<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RideRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RideRepository::class)]
#[ApiResource(
    paginationEnabled: false,
)]
class Ride
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $latStart = null;

    #[ORM\Column]
    private ?float $longStart = null;

    #[ORM\Column(nullable: true)]
    private ?float $latEnd = null;

    #[ORM\Column(nullable: true)]
    private ?float $longEnd = null;

    #[ORM\Column(nullable: true)]
    private ?int $km = null;

    #[ORM\ManyToOne(inversedBy: 'Rides')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Taxi $taxi = null;

    #[ORM\ManyToOne(inversedBy: 'rides')]
    private ?Client $client = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLatStart(): ?float
    {
        return $this->latStart;
    }

    public function setLatStart(float $latStart): static
    {
        $this->latStart = $latStart;

        return $this;
    }

    public function getLongStart(): ?float
    {
        return $this->longStart;
    }

    public function setLongStart(float $longStart): static
    {
        $this->longStart = $longStart;

        return $this;
    }

    public function getLatEnd(): ?float
    {
        return $this->latEnd;
    }

    public function setLatEnd(?float $latEnd): static
    {
        $this->latEnd = $latEnd;

        return $this;
    }

    public function getLongEnd(): ?float
    {
        return $this->longEnd;
    }

    public function setLongEnd(?float $longEnd): static
    {
        $this->longEnd = $longEnd;

        return $this;
    }

    public function getKm(): ?int
    {
        return $this->km;
    }

    public function setKm(?int $km): static
    {
        $this->km = $km;

        return $this;
    }

    public function getTaxi(): ?Taxi
    {
        return $this->taxi;
    }

    public function setTaxi(?Taxi $taxi): static
    {
        $this->taxi = $taxi;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }
}
