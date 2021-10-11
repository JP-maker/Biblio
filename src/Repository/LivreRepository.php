<?php

namespace App\Repository;

use App\Entity\Livre;
use App\Service\StringFormatService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Node\Expr\Array_;

/**
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    private StringFormatService $stringFormatService;
    public function __construct(ManagerRegistry $registry, StringFormatService $stringFormatService)
    {
        parent::__construct($registry, Livre::class);
        $this->stringFormatService = $stringFormatService;
    }

    public function searchAllBooks()
    {
        return $this->createQueryBuilder('l')
            ->join('l.auteur', 'a')
            ->addSelect('a')
            ->join('l.editeur','e')
            ->addSelect('e')
            ->join('l.genre','g')
            ->addSelect('g')
            ->join('l.description','d')
            ->addSelect('d')
            ->join('l.exemplaire','b')
            ->addSelect('b')
            ->getQuery()
            ->execute();
    }

    public function searchAllBooksWithFilters(Array $posts)
    {
        $query = $this->createQueryBuilder('l')
            ->join('l.auteur', 'a')
            ->addSelect('a')
            ->join('l.editeur','e')
            ->addSelect('e')
            ->join('l.genre','g')
            ->addSelect('g')
            ->join('l.description','d')
            ->addSelect('d')
            ->join('l.exemplaire','b')
            ->addSelect('b');

        if ($posts['titre'] != null) {
            $strSearch = $this->stringFormatService->prepareStrForSearch($posts['titre']);
            $query->where('upper(l.titre) LIKE :titre')
                ->setParameter('titre', '%'.$strSearch.'%');
        }
        if ($posts['auteur'] != null) {
            $strSearch = $this->stringFormatService->prepareStrForSearch($posts['auteur']);
            $query->andWhere('CONCAT(upper(a.prenom), upper(a.nom)) LIKE :auteur')
                ->setParameter('auteur', '%'.$strSearch.'%');
        }
        if ($posts['genre'] != null) {
            $query->andWhere('g.nom = :genre')
                ->setParameter('genre', $posts['genre']);
        }
        if ($posts['langue'] != null) {
            $query->andWhere('l.langue = :langue')
                ->setParameter('langue', $posts['langue']);
        }
        return   $query->getQuery()->execute();
    }

    // /**
    //  * @return Livre[] Returns an array of Livre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Livre
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
