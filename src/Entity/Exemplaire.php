<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Exemplaire
 *
 * @ORM\Table(name="exemplaire", indexes={@ORM\Index(name="IDX_5EF83C92CC1CF4E6", columns={"isbn"}), @ORM\Index(name="IDX_5EF83C924690D34D", columns={"bibliotheque"})})
 * @ORM\Entity
 */
class Exemplaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="exemplaire_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \Livre
     *
     * @ORM\ManyToOne(targetEntity="Livre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="isbn", referencedColumnName="isbn")
     * })
     */
    private $isbn;

    /**
     * @var \Bibliotheque
     *
     * @ORM\ManyToOne(targetEntity="Bibliotheque")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bibliotheque", referencedColumnName="nom")
     * })
     */
    private $bibliotheque;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsbn(): ?Livre
    {
        return $this->isbn;
    }

    public function setIsbn(?Livre $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getBibliotheque(): ?Bibliotheque
    {
        return $this->bibliotheque;
    }

    public function setBibliotheque(?Bibliotheque $bibliotheque): self
    {
        $this->bibliotheque = $bibliotheque;

        return $this;
    }


}
