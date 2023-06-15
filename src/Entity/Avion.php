<?php

namespace App\Entity;

use App\Repository\AvionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvionRepository::class)]
class Avion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $codigo = null;

    #[ORM\Column(length: 255)]
    private ?string $modelo = null;


    #[ORM\OneToMany(mappedBy: 'avion', targetEntity: Vuelo::class)]
    private Collection $vuelos;

    #[ORM\OneToMany(mappedBy: 'avion', targetEntity: Asiento::class)]
    private Collection $asientos;

    public function __construct()
    {
        $this->vuelos = new ArrayCollection();
        $this->asientos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getModelo(): ?string
    {
        return $this->modelo;
    }

    public function setModelo(string $modelo): self
    {
        $this->modelo = $modelo;

        return $this;
    }


    /**
     * @return Collection<int, Vuelo>
     */
    public function getVuelos(): Collection
    {
        return $this->vuelos;
    }

    public function addVuelo(Vuelo $vuelo): self
    {
        if (!$this->vuelos->contains($vuelo)) {
            $this->vuelos->add($vuelo);
            $vuelo->setAvion($this);
        }

        return $this;
    }

    public function removeVuelo(Vuelo $vuelo): self
    {
        if ($this->vuelos->removeElement($vuelo)) {
            // set the owning side to null (unless already changed)
            if ($vuelo->getAvion() === $this) {
                $vuelo->setAvion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Asiento>
     */
    public function getAsientos(): Collection
    {
        return $this->asientos;
    }

    public function addAsiento(Asiento $asiento): self
    {
        if (!$this->asientos->contains($asiento)) {
            $this->asientos->add($asiento);
            $asiento->setAvion($this);
        }

        return $this;
    }

    public function removeAsiento(Asiento $asiento): self
    {
        if ($this->asientos->removeElement($asiento)) {
            // set the owning side to null (unless already changed)
            if ($asiento->getAvion() === $this) {
                $asiento->setAvion(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->codigo;
    }
}
