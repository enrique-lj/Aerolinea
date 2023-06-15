<?php

namespace App\Entity;

use App\Repository\ReservaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservaRepository::class)]
class Reserva
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'reservas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $cliente = null;

    #[ORM\ManyToOne(inversedBy: 'reservas')]
    private ?Vuelo $vuelo = null;

    #[ORM\ManyToOne(inversedBy: 'reservas')]
    private ?Asiento $asiento = null;

    #[ORM\Column(nullable: true)]
    private ?bool $checkin = null;

    #[ORM\OneToOne(mappedBy: 'reserva', cascade: ['persist', 'remove'])]
    private ?Facturacion $facturacion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCliente(): ?User
    {
        return $this->cliente;
    }

    public function setCliente(?User $cliente): self
    {
        $this->cliente = $cliente;

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

    public function getAsiento(): ?Asiento
    {
        return $this->asiento;
    }

    public function setAsiento(?Asiento $asiento): self
    {
        $this->asiento = $asiento;

        return $this;
    }

    public function isCheckin(): ?bool
    {
        return $this->checkin;
    }

    public function setCheckin(?bool $checkin): self
    {
        $this->checkin = $checkin;

        return $this;
    }

    public function getFacturacion(): ?Facturacion
    {
        return $this->facturacion;
    }

    public function setFacturacion(?Facturacion $facturacion): self
    {
        // unset the owning side of the relation if necessary
        if ($facturacion === null && $this->facturacion !== null) {
            $this->facturacion->setReserva(null);
        }

        // set the owning side of the relation if necessary
        if ($facturacion !== null && $facturacion->getReserva() !== $this) {
            $facturacion->setReserva($this);
        }

        $this->facturacion = $facturacion;

        return $this;
    }
}
