<?php

namespace App\Entity;

use App\Repository\TarifablesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TarifablesRepository::class)]
class Tarifables
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $extra_asiento = null;

    #[ORM\Column]
    private ?bool $factura_maleta = null;

    #[ORM\Column]
    private ?bool $extra_seguro = null;

    #[ORM\Column]
    private ?bool $business = null;

    #[ORM\Column(length: 7)]
    private ?string $Precio = null;

    #[ORM\Column(length: 255)]
    private ?string $Nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $Descripcion = null;

    #[ORM\OneToMany(mappedBy: 'Tarifables', targetEntity: Facturacion::class)]
    private Collection $facturacions;

    public function __construct()
    {
        $this->facturacions = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExtraAsiento(): ?bool
    {
        return $this->extra_asiento;
    }

    public function setExtraAsiento(bool $extra_asiento): self
    {
        $this->extra_asiento = $extra_asiento;

        return $this;
    }

    public function isFacturaMaleta(): ?bool
    {
        return $this->factura_maleta;
    }

    public function setFacturaMaleta(bool $factura_maleta): self
    {
        $this->factura_maleta = $factura_maleta;

        return $this;
    }

    public function getExtraSeguro(): ?bool
    {
        return $this->extra_seguro;
    }

    public function setExtraSeguro(bool $extra_seguro): self
    {
        $this->extra_seguro = $extra_seguro;

        return $this;
    }

    public function isBusiness(): ?bool
    {
        return $this->business;
    }

    public function setBusiness(bool $business): self
    {
        $this->business = $business;

        return $this;
    }

    public function getPrecio(): ?string
    {
        return $this->Precio;
    }

    public function setPrecio(string $Precio): self
    {
        $this->Precio = $Precio;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->Descripcion;
    }

    public function setDescripcion(string $Descripcion): self
    {
        $this->Descripcion = $Descripcion;

        return $this;
    }

    /**
     * @return Collection<int, Facturacion>
     */
    public function getFacturacions(): Collection
    {
        return $this->facturacions;
    }

    public function addFacturacion(Facturacion $facturacion): self
    {
        if (!$this->facturacions->contains($facturacion)) {
            $this->facturacions->add($facturacion);
            $facturacion->setTarifables($this);
        }

        return $this;
    }

    public function removeFacturacion(Facturacion $facturacion): self
    {
        if ($this->facturacions->removeElement($facturacion)) {
            // set the owning side to null (unless already changed)
            if ($facturacion->getTarifables() === $this) {
                $facturacion->setTarifables(null);
            }
        }

        return $this;
    }
}
