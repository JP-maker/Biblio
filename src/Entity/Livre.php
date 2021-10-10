<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Livre
 *
 * @ORM\Table(name="livre", indexes={@ORM\Index(name="IDX_AC634F993375BD21", columns={"editeur_id"}), @ORM\Index(name="IDX_AC634F99D9F966B", columns={"description_id"}), @ORM\Index(name="IDX_AC634F999357758E", columns={"langue"})})
 * @ORM\Entity(repositoryClass=App\Repository\LivreRepository::class)
 */
class Livre
{
    /**
     * @var string
     *
     * @ORM\Column(name="isbn", type="string", length=20, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="livre_isbn_seq", allocationSize=1, initialValue=1)
     */
    private $isbn;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=100, nullable=false)
     */
    private $titre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_publication", type="datetime", nullable=false)
     */
    private $datePublication;

    /**
     * @var \Editeur
     *
     * @ORM\ManyToOne(targetEntity="Editeur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="editeur_id", referencedColumnName="id")
     * })
     */
    private $editeur;

    /**
     * @var \Description
     *
     * @ORM\ManyToOne(targetEntity="Description")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="description_id", referencedColumnName="id")
     * })
     */
    private $description;

    /**
     * @var \Langue
     *
     * @ORM\ManyToOne(targetEntity="Langue")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="langue", referencedColumnName="nom")
     * })
     */
    private $langue;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Genre", inversedBy="isbn")
     * @ORM\JoinTable(name="livre_genre",
     *   joinColumns={
     *     @ORM\JoinColumn(name="isbn", referencedColumnName="isbn")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="nom", referencedColumnName="nom")
     *   }
     * )
     */
    private $genre;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Auteur", inversedBy="isbn")
     * @ORM\JoinTable(name="livre_auteur",
     *   joinColumns={
     *     @ORM\JoinColumn(name="isbn", referencedColumnName="isbn")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="auteur_id", referencedColumnName="id")
     *   }
     * )
     */
    private $auteur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Bibliotheque", inversedBy="isbn")
     * @ORM\JoinTable(name="exemplaire",
     *   joinColumns={
     *     @ORM\JoinColumn(name="isbn", referencedColumnName="isbn")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="bibliotheque", referencedColumnName="nom")
     *   }
     * )
     */
    private $exemplaire;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->genre = new \Doctrine\Common\Collections\ArrayCollection();
        $this->auteur = new \Doctrine\Common\Collections\ArrayCollection();
        $this->exemplaire = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->datePublication;
    }

    public function setDatePublication(\DateTimeInterface $datePublication): self
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    public function getEditeur(): ?Editeur
    {
        return $this->editeur;
    }

    public function setEditeur(?Editeur $editeur): self
    {
        $this->editeur = $editeur;

        return $this;
    }

    public function getDescription(): ?Description
    {
        return $this->description;
    }

    public function setDescription(?Description $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLangue(): ?Langue
    {
        return $this->langue;
    }

    public function setLangue(?Langue $langue): self
    {
        $this->langue = $langue;

        return $this;
    }

    /**
     * @return Collection|Genre[]
     */
    public function getGenre(): Collection
    {
        return $this->genre;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genre->contains($genre)) {
            $this->genre[] = $genre;
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        $this->genre->removeElement($genre);

        return $this;
    }

    /**
     * @return Collection|Auteur[]
     */
    public function getAuteur(): Collection
    {
        return $this->auteur;
    }

    public function addAuteur(Auteur $auteur): self
    {
        if (!$this->auteur->contains($auteur)) {
            $this->auteur[] = $auteur;
        }

        return $this;
    }

    public function removeAuteur(Auteur $auteur): self
    {
        $this->auteur->removeElement($auteur);

        return $this;
    }

    /**
     * @return Collection|Exemplaire[]
     */
    public function getExemplaire(): Collection
    {
        return $this->exemplaire;
    }

    public function addExemplaire(Bibliotheque $exemplaire): self
    {
        if (!$this->exemplaire->contains($exemplaire)) {
            $this->exemplaire[] = $exemplaire;
        }

        return $this;
    }

    public function removeExemplaire(Bibliotheque $exemplaire): self
    {
        $this->exemplaire->removeElement($exemplaire);

        return $this;
    }

}
