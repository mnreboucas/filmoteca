<?php

namespace App\Entity;

use App\Repository\FilmePremioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilmePremioRepository::class)]
class FilmePremio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Filme::class, inversedBy: 'filmePremios')]
    #[ORM\JoinColumn(nullable: false)]
    private $filme;

    #[ORM\ManyToOne(targetEntity: Premio::class, inversedBy: 'filmePremios')]
    #[ORM\JoinColumn(nullable: false)]
    private $premio;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $ano;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilme(): ?Filme
    {
        return $this->filme;
    }

    public function setFilme(?Filme $filme): self
    {
        $this->filme = $filme;

        return $this;
    }

    public function getPremio(): ?Premio
    {
        return $this->premio;
    }

    public function setPremio(?Premio $premio): self
    {
        $this->premio = $premio;

        return $this;
    }

    public function getAno(): ?int
    {
        return $this->ano;
    }

    public function setAno(?int $ano): self
    {
        $this->ano = $ano;

        return $this;
    }
}
