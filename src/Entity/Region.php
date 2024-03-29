<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity]
class Region
{
    #[Id, GeneratedValue, Column]
    private int $id;

    #[OneToMany(targetEntity: State::class, mappedBy: 'region', cascade: ['persist', 'remove'])]
    private Collection $states;

    public function __construct(
        #[Column]
        private string $name
    ) {
        $this->states = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getStates(): Collection
    {
        return $this->states;
    }

    public function addState(State $state): void
    {
        $this->states->add($state);
        $state->setRegion($this);
    }
}
