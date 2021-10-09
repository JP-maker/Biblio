<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Langue
 *
 * @ORM\Table(name="langue")
 * @ORM\Entity(repositoryClass=App\Repository\LangueRepository::class)
 */
class Langue
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="langue_nom_seq", allocationSize=1, initialValue=1)
     */
    private $nom;

    public function getNom(): ?string
    {
        return $this->nom;
    }


}
