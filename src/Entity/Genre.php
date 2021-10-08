<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Genre
 *
 * @ORM\Table(name="genre")
 * @ORM\Entity
 */
class Genre
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=20, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="genre_nom_seq", allocationSize=1, initialValue=1)
     */
    private $nom;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Livre", mappedBy="nom")
     */
    private $isbn;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->isbn = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @return Collection|Livre[]
     */
    public function getIsbn(): Collection
    {
        return $this->isbn;
    }

    public function addIsbn(Livre $isbn): self
    {
        if (!$this->isbn->contains($isbn)) {
            $this->isbn[] = $isbn;
            $isbn->addNom($this);
        }

        return $this;
    }

    public function removeIsbn(Livre $isbn): self
    {
        if ($this->isbn->removeElement($isbn)) {
            $isbn->removeNom($this);
        }

        return $this;
    }

}
