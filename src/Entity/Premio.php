<?php

namespace App\Entity;

use App\Repository\PremioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PremioRepository::class)]
class Premio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $descricao;

    #[ORM\Column(type: 'boolean', options: ["default" => 1])]
    private $ativo;

    #[ORM\OneToMany(mappedBy: 'premio', targetEntity: FilmePremio::class, orphanRemoval: true)]
    private $filmePremios;

    public function __construct()
    {
        $this->filmePremios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getAtivo(): ?bool
    {
        return $this->ativo;
    }

    public function setAtivo(bool $ativo): self
    {
        $this->ativo = $ativo;

        return $this;
    }

    /**
     * @return Collection|FilmePremio[]
     */
    public function getFilmePremios(): Collection
    {
        return $this->filmePremios;
    }

    public function addFilmePremio(FilmePremio $filmePremio): self
    {
        if (!$this->filmePremios->contains($filmePremio)) {
            $this->filmePremios[] = $filmePremio;
            $filmePremio->setPremio($this);
        }

        return $this;
    }

    public function removeFilmePremio(FilmePremio $filmePremio): self
    {
        if ($this->filmePremios->removeElement($filmePremio)) {
            // set the owning side to null (unless already changed)
            if ($filmePremio->getPremio() === $this) {
                $filmePremio->setPremio(null);
            }
        }

        return $this;
    }
}
