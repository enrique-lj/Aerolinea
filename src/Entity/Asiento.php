<?php

namespace App\Entity;

use App\Repository\AsientoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AsientoRepository::class)]
class Asiento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'asientos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Avion $avion = null;

    #[ORM\Column]
    private ?int $fila = null;

    #[ORM\Column(length: 255)]
    private ?string $columna = null;

    #[ORM\Column(length: 255)]
    private ?string $clase = null;

    #[ORM\OneToMany(mappedBy: 'asiento', targetEntity: Reserva::class)]
    private Collection $reservas;

    #[ORM\Column(nullable: true)]
    private ?bool $Ocupado = null;

    #[ORM\ManyToOne(inversedBy: 'Asientos')]
    private ?Vuelo $vuelo = null;

    public function __construct()
    {
        $this->reservas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAvion(): ?Avion
    {
        return $this->avion;
    }

    public function setAvion(?Avion $avion): self
    {
        $this->avion = $avion;

        return $this;
    }

    public function getFila(): ?int
    {
        return $this->fila;
    }

    public function setFila(int $fila): self
    {
        $this->fila = $fila;

        return $this;
    }

    public function getColumna(): ?string
    {
        return $this->columna;
    }

    public function setColumna(string $columna): self
    {
        $this->columna = $columna;

        return $this;
    }

    public function getClase(): ?string
    {
        return $this->clase;
    }

    public function setClase(string $clase): self
    {
        $this->clase = $clase;

        return $this;
    }

    /**
     * @return Collection<int, Reserva>
     */
    public function getReservas(): Collection
    {
        return $this->reservas;
    }

    public function addReserva(Reserva $reserva): self
    {
        if (!$this->reservas->contains($reserva)) {
            $this->reservas->add($reserva);
            $reserva->setAsiento($this);
        }

        return $this;
    }

    public function removeReserva(Reserva $reserva): self
    {
        if ($this->reservas->removeElement($reserva)) {
            // set the owning side to null (unless already changed)
            if ($reserva->getAsiento() === $this) {
                $reserva->setAsiento(null);
            }
        }

        return $this;
    }

    public function isOcupado(): ?bool
    {
        return $this->Ocupado;
    }

    public function setOcupado(?bool $Ocupado): self
    {
        $this->Ocupado = $Ocupado;

        return $this;
    }

    public function getVuelo(): ?Vuelo
    {
        return $this->vuelo;
    }

    public function setVuelo(?Vuelo $vuelo): self
    {
        $this->vuelo = $vuelo;

        return $this;
    }

    public function __toString()
    {
        return $this->fila.$this->columna;
    }
}
