<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paragraphe
 *
 * @ORM\Table(name="paragraphe", indexes={@ORM\Index(name="IDX_4C1BA9B6D9F966B", columns={"description_id"})})
 * @ORM\Entity(repositoryClass=App\Repository\ParagrapheRepository::class)
 */
class Paragraphe
{
    /**
     * @var int
     *
     * @ORM\Column(name="ordre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $ordre;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="string", nullable=false)
     */
    private $texte;

    /**
     * @var \Description
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Description")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="description_id", referencedColumnName="id")
     * })
     */
    private $description;

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): self
    {
        $this->texte = $texte;

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


}
