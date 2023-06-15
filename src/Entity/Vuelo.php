<?php

namespace App\Entity;

use App\Repository\VueloRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VueloRepository::class)]
class Vuelo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'vuelos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Avion $avion = null;

    #[ORM\ManyToOne(inversedBy: 'vuelos')]
    private ?Ruta $ruta = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    public ?\DateTimeInterface $fecha_salida = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    public ?\DateTimeInterface $fecha_llegada = null;

    #[ORM\Column]
    public ?string $precio_base = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $estado = null;

    #[ORM\OneToMany(mappedBy: 'vuelo', targetEntity: Reserva::class)]
    private Collection $reservas;

    #[ORM\OneToMany(mappedBy: 'vuelo', targetEntity: Asiento::class)]
    private Collection $Asientos;

    public function __construct()
    {
        $this->reservas = new ArrayCollection();
        $this->Asientos = new ArrayCollection();
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

    public function getRuta(): ?Ruta
    {
        return $this->ruta;
    }

    public function setRuta(?Ruta $ruta): self
    {
        $this->ruta = $ruta;

        return $this;
    }

    public function getFechaSalida(): ?\DateTimeInterface
    {
        return $this->fecha_salida;
    }

    public function setFechaSalida(\DateTimeInterface $fecha_salida): self
    {
        $this->fecha_salida = $fecha_salida;

        return $this;
    }

    public function getFechaLlegada(): ?\DateTimeInterface
    {
        return $this->fecha_llegada;
    }

    public function setFechaLlegada(?\DateTimeInterface $fecha_llegada): self
    {
        $this->fecha_llegada = $fecha_llegada;

        return $this;
    }

    public function getPrecioBase(): ?string
    {
        return $this->precio_base;
    }

    public function setPrecioBase(string $precio_base): self
    {
        $this->precio_base = $precio_base;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(?string $estado): self
    {
        $this->estado = $estado;

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
            $reserva->setVuelo($this);
        }

        return $this;
    }

    public function removeReserva(Reserva $reserva): self
    {
        if ($this->reservas->removeElement($reserva)) {
            // set the owning side to null (unless already changed)
            if ($reserva->getVuelo() === $this) {
                $reserva->setVuelo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Asiento>
     */
    public function getAsientos(): Collection
    {
        return $this->Asientos;
    }

    public function addAsiento(Asiento $asiento): self
    {
        if (!$this->Asientos->contains($asiento)) {
            $this->Asientos->add($asiento);
            $asiento->setVuelo($this);
        }

        return $this;
    }

    public function removeAsiento(Asiento $asiento): self
    {
        if ($this->Asientos->removeElement($asiento)) {
            // set the owning side to null (unless already changed)
            if ($asiento->getVuelo() === $this) {
                $asiento->setVuelo(null);
            }
        }

        return $this;
    }
}
