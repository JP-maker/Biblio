<?php

namespace App\Repository;

use App\Entity\Pret;
use App\Entity\Utilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pret|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pret|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pret[]    findAll()
 * @method Pret[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PretRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pret::class);
    }
    public function searchAllBooks(Utilisateur $user)
    {
        return $this->createQueryBuilder('p')
            ->join('p.exemplaire', 'e')
            ->join('e.isbn','l')
            ->addSelect('e')
            ->addSelect('l')
            ->join('l.auteur', 'a')
            ->addSelect('a')
            ->join('l.editeur','ed')
            ->addSelect('ed')
            ->join('l.genre','g')
            ->addSelect('g')
            ->where('p.utilisateur = :util')
            ->setParameter('util', $user)
            ->getQuery()
            ->execute();
    }

    // /**
    //  * @return Pret[] Returns an array of Pret objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pret
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
