<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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



    // /**
    //  * @return Event[] Returns an array of Event objects
    //  */

/*     public function getByName() :array
    {
        $events = $this->createQueryBuilder('m');
        $events->orderBy('m.name', 'ASC');
        return $events->getQuery()->getResult();
    } */


    public function countBydate($date) :string
    {
         $events = $this->createQueryBuilder('m')
         ->andWhere('m.startAt > :date')
         ->setParameter(':date', $date)
         ->select('count(m)');

         return $events->getQuery()->getSingleScalarResult();
    }
     






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
