<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 128)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Publications::class, orphanRemoval: true)]
    private Collection $publications;

    #[ORM\Column(length: 15)]
    private ?string $couleur = null;

    #[ORM\ManyToMany(targetEntity: Niveaux::class, inversedBy: 'categories')]
    private Collection $niveau;

    public function __construct()
    {
        $this->publications = new ArrayCollection();
        $this->niveau = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nom;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Publications>
     */
    public function getPublications(): Collection
    {
        return $this->publications;
    }

    public function addPublication(Publications $publication): self
    {
        if (!$this->publications->contains($publication)) {
            $this->publications->add($publication);
            $publication->setCategorie($this);
        }

        return $this;
    }

    public function removePublication(Publications $publication): self
    {
        if ($this->publications->removeElement($publication)) {
            // set the owning side to null (unless already changed)
            if ($publication->getCategorie() === $this) {
                $publication->setCategorie(null);
            }
        }

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * @return Collection<int, Niveaux>
     */
    public function getNiveau(): Collection
    {
        return $this->niveau;
    }

    public function addNiveau(Niveaux $niveau): self
    {
        if (!$this->niveau->contains($niveau)) {
            $this->niveau->add($niveau);
        }

        return $this;
    }

    public function removeNiveau(Niveaux $niveau): self
    {
        $this->niveau->removeElement($niveau);

        return $this;
    }
}