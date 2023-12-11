<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;

#[Entity]
class Business
{
    #[Id, GeneratedValue, Column]
    private int $id;

    #[ManyToMany(City::class, mappedBy: 'business')]
    private Collection $cities;

    public function __construct(
        #[Column]
        private string $name
    ) {
        $this->cities = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCities(): Collection
    {
        return $this->cities;
    }

    public function addCity(City $city): void
    {
        if ($this->cities->contains($city)) {
            return;
        }

        $this->cities->add($city);
        $city->openBusiness($this);
    }
}
