<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\DriverRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DriverRepository::class)]
#[ApiResource(
    paginationEnabled: false,
)]
class Driver
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $LicenseNumber = null;

    /**
     * @var Collection<int, Taxi>
     */
    #[ORM\OneToMany(targetEntity: Taxi::class, mappedBy: 'driver')]
    private Collection $taxis;

    public function __construct()
    {
        $this->taxis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLicenseNumber(): ?string
    {
        return $this->LicenseNumber;
    }

    public function setLicenseNumber(string $LicenseNumber): static
    {
        $this->LicenseNumber = $LicenseNumber;

        return $this;
    }

    /**
     * @return Collection<int, Taxi>
     */
    public function getTaxis(): Collection
    {
        return $this->taxis;
    }

    public function addTaxi(Taxi $taxi): static
    {
        if (!$this->taxis->contains($taxi)) {
            $this->taxis->add($taxi);
            $taxi->setDriver($this);
        }

        return $this;
    }

    public function removeTaxi(Taxi $taxi): static
    {
        if ($this->taxis->removeElement($taxi)) {
            // set the owning side to null (unless already changed)
            if ($taxi->getDriver() === $this) {
                $taxi->setDriver(null);
            }
        }

        return $this;
    }
}
