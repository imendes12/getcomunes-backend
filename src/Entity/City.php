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
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity]
class City
{
    #[Id, GeneratedValue, Column]
    private int $id;

    #[ManyToOne(targetEntity: State::class)]
    private State $state;

    #[ManyToMany(Business::class, inversedBy: 'cities')]
    private Collection $business;

    public function __construct(
        #[Column]
        private string $name
    ) {
        $this->business = new ArrayCollection();
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

    public function getState(): State
    {
        return $this->state;
    }

    public function setState(State $state): void
    {
        $this->state = $state;
    }

    public function getBusiness(): Collection
    {
        return $this->business;
    }

    public function openBusiness(Business $business): void
    {
        if ($this->business->contains($business)) {
            return;
        }

        $this->business->add($business);
        $business->addCity($this);
    }
}
