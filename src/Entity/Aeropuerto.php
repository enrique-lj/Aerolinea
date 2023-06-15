<?php

namespace App\Entity;

use App\Repository\AeropuertoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AeropuertoRepository::class)]
class Aeropuerto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $localidad = null;

    #[ORM\OneToMany(mappedBy: 'origen', targetEntity: Ruta::class)]
    private Collection $rutas;

    public function __construct()
    {
        $this->rutas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getLocalidad(): ?string
    {
        return $this->localidad;
    }

    public function setLocalidad(string $localidad): self
    {
        $this->localidad = $localidad;

        return $this;
    }

    /**
     * @return Collection<int, Ruta>
     */
    public function getRutas(): Collection
    {
        return $this->rutas;
    }

    public function addRuta(Ruta $ruta): self
    {
        if (!$this->rutas->contains($ruta)) {
            $this->rutas->add($ruta);
            $ruta->setOrigen($this);
        }

        return $this;
    }

    public function removeRuta(Ruta $ruta): self
    {
        if ($this->rutas->removeElement($ruta)) {
            // set the owning side to null (unless already changed)
            if ($ruta->getOrigen() === $this) {
                $ruta->setOrigen(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->localidad;
    }
}
