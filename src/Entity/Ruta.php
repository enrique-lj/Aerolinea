<?php

namespace App\Entity;

use App\Repository\RutaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RutaRepository::class)]
class Ruta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'rutas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Aeropuerto $origen = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Aeropuerto $destino = null;

    #[ORM\OneToMany(mappedBy: 'ruta', targetEntity: Vuelo::class)]
    private Collection $vuelos;

    public function __construct()
    {
        $this->vuelos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrigen(): ?Aeropuerto
    {
        return $this->origen;
    }

    public function setOrigen(?Aeropuerto $origen): self
    {
        $this->origen = $origen;

        return $this;
    }

    public function getDestino(): ?Aeropuerto
    {
        return $this->destino;
    }

    public function setDestino(?Aeropuerto $destino): self
    {
        $this->destino = $destino;

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
            $vuelo->setRuta($this);
        }

        return $this;
    }

    public function removeVuelo(Vuelo $vuelo): self
    {
        if ($this->vuelos->removeElement($vuelo)) {
            // set the owning side to null (unless already changed)
            if ($vuelo->getRuta() === $this) {
                $vuelo->setRuta(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->origen.' a '.$this->destino;
    }
}
