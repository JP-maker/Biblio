<?php

namespace App\Repository;

use App\Entity\Exemplaire;
use App\Entity\Pret;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Exemplaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exemplaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exemplaire[]    findAll()
 * @method Exemplaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExemplaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exemplaire::class);
    }
    public function searchAllBookBiblio()
    {

        $em = $this->getEntityManager();

        $subQuery = $em->createQueryBuilder()
            ->select('p')
            ->from('App\Entity\Pret', 'p')
            ->getDQL()
        ;

        $query = $em->createQueryBuilder();
        $query->Select('e')
            ->from('App\Entity\Exemplaire', 'e')
            ->where($query->expr()->notIn('e.id', $subQuery))
        ;

        return  $query->getQuery()->getResult();

    }

    // /**
    //  * @return Exemplaire[] Returns an array of Exemplaire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Exemplaire
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
