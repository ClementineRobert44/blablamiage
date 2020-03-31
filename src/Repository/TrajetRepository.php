<?php

namespace App\Repository;

use App\Entity\Trajet;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\AST\Join;
use Doctrine\ORM\Query\Expr\Join as ExprJoin;

/**
 * @method Trajet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trajet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trajet[]    findAll()
 * @method Trajet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Trajet[]|null    getTrajetsExpires(int $id)
 */
class TrajetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trajet::class);
    }

    // /**
    //  * @return Trajet[] Returns an array of Trajet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Trajet
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
    * @return Trajet[]
    */

    public function getTrajetsExpires(){

        return $this->createQueryBuilder('t')
            ->andWhere('t.dateDepart < :dateDuJour')
            ->setParameter('dateDuJour', new DateTime())
            ->getQuery()
            ->getResult()
        ;
    }

    public function getTrajetsAVenir(){

        return $this->createQueryBuilder('t')
            ->andWhere('t.dateDepart > :dateDuJour')
            ->setParameter('dateDuJour', new DateTime())
            ->getQuery()
            ->getResult()
        ;
    }

    

    
      
    
}
