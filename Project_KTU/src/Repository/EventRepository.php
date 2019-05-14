<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use phpDocumentor\Reflection\Types\Float_;
use PhpParser\Node\Expr\Cast\String_;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Event::class);
    }

    /**
     * @param string $title
     * @param string $category
     * @param array $date
     * @param string $price_from
     * @param string $price_up_to
     * @return array
     */
    public function findByFilterData(string $title, string $category, array $date,
                                     string $price_from, string $price_up_to): array
    {
        $gb = $this->createQueryBuilder('event');

        $this->findByTitle($gb, $title);

        if ($category != null){
            $this->findByCategory($gb, $category);
        }
        if ($date['month'] != null || $date['day'] != null || $date['year'] != null){
            $this->findByDate($gb, $date);
        }
        if ($price_from != null && $price_up_to != null){
            $this->findByPrice($gb, $price_from, $price_up_to);
        }
        else if ($price_from != null || $price_up_to != null){
            if($price_from != null){
                $this->findByPriceFrom($gb, $price_from);
            }
            else{
                $this->findByPriceUpTo($gb, $price_up_to);
            }
        }

        return $gb->getQuery()->execute();
    }

    /**
     * @param QueryBuilder $builder
     * @param string $title
     */
    public function findByTitle(QueryBuilder $builder, string $title):void
    {
        $builder->andWhere($builder->expr()->like('event.Title', ':name'))
            ->setParameter('name', '%'.$title.'%');
    }

    /**
     * @param QueryBuilder $builder
     * @param string $category
     */
    public function findByCategory(QueryBuilder $builder, string $category):void
    {
        $builder->andWhere($builder->expr()->like('event.Category', ':category'))
            ->setParameter('category', '%'.$category.'%');
    }

    /**
     * @param QueryBuilder $builder
     * @param array $date
     */
    public function findByDate(QueryBuilder $builder, array $date):void
    {
        $builder->andWhere('event.Date = :date')
            ->setParameter('date', $date['year'].'-'.$date['month'].'-'.$date['day']);
    }

    /**
     * @param QueryBuilder $builder
     * @param string $price_from
     * @param string $price_up_to
     */
    public function findByPrice(QueryBuilder $builder, string $price_from, string $price_up_to):void
    {
        $builder->andWhere('event.Price BETWEEN :price_from AND :price_up_to')
            ->setParameter('price_from', $price_from)
            ->setParameter('price_up_to', $price_up_to);
    }

    /**
     * @param QueryBuilder $builder
     * @param string $price_from
     */
    public function findByPriceFrom(QueryBuilder $builder, string $price_from):void
    {
        $builder->andWhere('event.Price >= :price_from')
            ->setParameter('price_from', $price_from);
    }

    /**
     * @param QueryBuilder $builder
     * @param string $price_up_to
     */
    public function findByPriceUpTo(QueryBuilder $builder, string $price_up_to):void
    {
        $builder->andWhere('event.Price <= :price_up_to')
            ->setParameter('price_up_to', $price_up_to);
    }

    // /**
    //  * @return Event[] Returns an array of Event objects
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
    public function findOneBySomeField($value): ?Event
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
