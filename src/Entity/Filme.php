<?php

namespace App\Entity;

use App\Repository\FilmeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilmeRepository::class)]
class Filme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titulo;

    #[ORM\Column(type: 'integer', length: 4, nullable: true)]
    private $ano;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $pais;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $diretor;

    #[ORM\ManyToOne(targetEntity: Genero::class, inversedBy: 'filmes')]
    private $genero;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $observacao;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $localizacao;

    #[ORM\OneToMany(mappedBy: 'filme', targetEntity: Imagem::class)]
    private $imagem;

    #[ORM\OneToMany(mappedBy: 'filme', targetEntity: FilmePremio::class, orphanRemoval: true)]
    private $filmePremios;

    public function __construct()
    {
        $this->imagem = new ArrayCollection();
        $this->filmePremios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

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

    public function getPais(): ?string
    {
        return $this->pais;
    }

    public function setPais(?string $pais): self
    {
        $this->pais = $pais;

        return $this;
    }

    public function getDiretor(): ?string
    {
        return $this->diretor;
    }

    public function setDiretor(?string $diretor): self
    {
        $this->diretor = $diretor;

        return $this;
    }

    public function getGenero(): ?Genero
    {
        return $this->genero;
    }

    public function setGenero(?Genero $genero): self
    {
        $this->genero = $genero;

        return $this;
    }

    public function getObservacao(): ?string
    {
        return $this->observacao;
    }

    public function setObservacao(?string $observacao): self
    {
        $this->observacao = $observacao;

        return $this;
    }

    public function getLocalizacao(): ?string
    {
        return $this->localizacao;
    }

    public function setLocalizacao(?string $localizacao): self
    {
        $this->localizacao = $localizacao;

        return $this;
    }

    /**
     * @return Collection|Imagem[]
     */
    public function getImagem(): Collection
    {
        return $this->imagem;
    }

    public function addImagem(Imagem $imagem): self
    {
        if (!$this->imagem->contains($imagem)) {
            $this->imagem[] = $imagem;
            $imagem->setFilme($this);
        }

        return $this;
    }

    public function removeImagem(Imagem $imagem): self
    {
        if ($this->imagem->removeElement($imagem)) {
            // set the owning side to null (unless already changed)
            if ($imagem->getFilme() === $this) {
                $imagem->setFilme(null);
            }
        }

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
            $filmePremio->setFilme($this);
        }

        return $this;
    }

    public function removeFilmePremio(FilmePremio $filmePremio): self
    {
        if ($this->filmePremios->removeElement($filmePremio)) {
            // set the owning side to null (unless already changed)
            if ($filmePremio->getFilme() === $this) {
                $filmePremio->setFilme(null);
            }
        }

        return $this;
    }
}
