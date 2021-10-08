<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pret
 *
 * @ORM\Table(name="pret", indexes={@ORM\Index(name="IDX_52ECE979FB88E14F", columns={"utilisateur_id"}), @ORM\Index(name="IDX_52ECE9795843AA21", columns={"exemplaire_id"})})
 * @ORM\Entity
 */
class Pret
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="pret_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="datetime", nullable=false)
     */
    private $dateDebut;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_fin", type="datetime", nullable=true)
     */
    private $dateFin;

    /**
     * @var bool
     *
     * @ORM\Column(name="renouvele", type="boolean", nullable=false)
     */
    private $renouvele;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id")
     * })
     */
    private $utilisateur;

    /**
     * @var \Exemplaire
     *
     * @ORM\ManyToOne(targetEntity="Exemplaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="exemplaire_id", referencedColumnName="id")
     * })
     */
    private $exemplaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getRenouvele(): ?bool
    {
        return $this->renouvele;
    }

    public function setRenouvele(bool $renouvele): self
    {
        $this->renouvele = $renouvele;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getExemplaire(): ?Exemplaire
    {
        return $this->exemplaire;
    }

    public function setExemplaire(?Exemplaire $exemplaire): self
    {
        $this->exemplaire = $exemplaire;

        return $this;
    }


}
