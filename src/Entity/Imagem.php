<?php

namespace App\Entity;

use App\Repository\ImagemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImagemRepository::class)]
class Imagem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nomeOriginal;

    #[ORM\Column(type: 'string', length: 255)]
    private $nomeFisico;

    #[ORM\ManyToOne(targetEntity: Filme::class, inversedBy: 'imagem')]
    private $filme;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeOriginal(): ?string
    {
        return $this->nomeOriginal;
    }

    public function setNomeOriginal(string $nomeOriginal): self
    {
        $this->nomeOriginal = $nomeOriginal;

        return $this;
    }

    public function getNomeFisico(): ?string
    {
        return $this->nomeFisico;
    }

    public function setNomeFisico(string $nomeFisico): self
    {
        $this->nomeFisico = $nomeFisico;

        return $this;
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
}
