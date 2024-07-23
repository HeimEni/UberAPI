<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CarModelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarModelRepository::class)]
#[ApiResource(
    paginationEnabled: false,
)]
class CarModel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $brand = null;

    #[ORM\Column(length: 255)]
    private ?string $model = null;

    /**
     * @var Collection<int, Taxi>
     */
    #[ORM\OneToMany(targetEntity: Taxi::class, mappedBy: 'CarModel')]
    private Collection $taxis;

    public function __construct()
    {
        $this->taxis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

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
            $taxi->setCarModel($this);
        }

        return $this;
    }

    public function removeTaxi(Taxi $taxi): static
    {
        if ($this->taxis->removeElement($taxi)) {
            // set the owning side to null (unless already changed)
            if ($taxi->getCarModel() === $this) {
                $taxi->setCarModel(null);
            }
        }

        return $this;
    }
}
