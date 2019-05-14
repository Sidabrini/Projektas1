<?php

namespace App\Repository;

use App\Entity\Subscribtion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Subscribtion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subscribtion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subscribtion[]    findAll()
 * @method Subscribtion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubscribtionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Subscribtion::class);
    }

    // /**
    //  * @return Subscribtion[] Returns an array of Subscribtion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Subscribtion
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
