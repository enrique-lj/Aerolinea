<?php

namespace App\Entity;

use App\Repository\FacturacionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FacturacionRepository::class)]
class Facturacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'facturacion', cascade: ['persist', 'remove'])]
    private ?Reserva $reserva = null;

    #[ORM\ManyToOne(inversedBy: 'facturacions')]
    private ?Tarifables $tarifables = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReserva(): ?Reserva
    {
        return $this->reserva;
    }

    public function setReserva(?Reserva $reserva): self
    {
        $this->reserva = $reserva;

        return $this;
    }

    public function getTarifables(): ?Tarifables
    {
        return $this->tarifables;
    }

    public function setTarifables(?Tarifables $tarifables): self
    {
        $this->tarifables = $tarifables;

        return $this;
    }
}
