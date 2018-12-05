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

     public function search(?string $name, $sort, $page) 
    {

        //Système de Barre de recherche
        $stmt = $this->createQueryBuilder('event') 
                     ->andWhere('event.name LIKE :term') 
                     ->setParameter(':term',  '%' .$name .'%');
    
        //Système de tri
        if ($sort == "price"){
            $stmt->orderBy('event.price' , 'ASC');

        } else if($sort == "date"){
            $stmt->orderBy('event.createdAt', 'DESC');
        }
    
        //Système de pagination
        $limit = 4;
        $stmt->setMaxResults($limit);
        $stmt->setFirstResult(($page-1) * $limit);

        //RESULTAT
        return $stmt->getQuery()->getResult();
                
    }  














    public function countBydate() :string
    {
         return $this->createQueryBuilder('m')
                     ->select('count(m)')
                     ->andWhere('m.startAt > :date')
                     ->setParameter(':date', new \DateTime())
                     ->getQuery()
                     ->getSingleScalarResult();
    }

    public function sortByPrice() 
    {
        return  $this->createQueryBuilder('m') 
                     ->orderBy('m.price' , 'ASC')
                     ->getQuery()
                     ->getResult();
    } 

    public function sortByDate()
    {
        return  $this->createQueryBuilder('m') 
                     ->orderBy('m.startAt' , 'ASC')
                     ->getQuery()
                     ->getResult();
    } 


}

//SYSTEME DE TRI 
// Action sur les templates
// Controller avec le service Request
// On le passe au service -> qui le renvoie au repo