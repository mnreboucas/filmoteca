<?php

namespace App\Entity;

use App\Repository\GeneroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GeneroRepository::class)]
class Genero
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $descricao;

    #[ORM\Column(type: 'boolean')]
    private $ativo;

    #[ORM\OneToMany(mappedBy: 'genero', targetEntity: Filme::class)]
    private $filmes;

    public function __construct()
    {
        $this->filmes = new ArrayCollection();
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
     * @return Collection|Filme[]
     */
    public function getFilmes(): Collection
    {
        return $this->filmes;
    }

    public function addFilme(Filme $filme): self
    {
        if (!$this->filmes->contains($filme)) {
            $this->filmes[] = $filme;
            $filme->setGenero($this);
        }

        return $this;
    }

    public function removeFilme(Filme $filme): self
    {
        if ($this->filmes->removeElement($filme)) {
            // set the owning side to null (unless already changed)
            if ($filme->getGenero() === $this) {
                $filme->setGenero(null);
            }
        }

        return $this;
    }
}
