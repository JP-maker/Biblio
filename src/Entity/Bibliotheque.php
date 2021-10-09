<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bibliotheque
 *
 * @ORM\Table(name="bibliotheque")
 * @ORM\Entity(repositoryClass=App\Repository\BibliothequeRepository::class)
 */
class Bibliotheque
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="bibliotheque_nom_seq", allocationSize=1, initialValue=1)
     */
    private $nom;

    public function getNom(): ?string
    {
        return $this->nom;
    }


}
