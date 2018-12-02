<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Event;

use App\Repository\EventRepository;

class EventService {

    private $em;

    public function __construct(ObjectManager $em){

        $this->em = $em;

    }

/*      public $events = [ 

        [ 
            'id' => 1,
            'name' => 'Au bon Gueulton',
            'category' => 'Dégustation fromage et bière du Nord',
            'presentation' =>'Un événement simple et familial',
            'content' => 'Lorem * 150',
            'localisation' => " Bistrot du Lannoy, 59510 Hem",
            'image' => '../../assets/images/poster/biere.jpg',
            'date_creation' => '2018-12-20 21:00:00',
            'date_start' => '2018-12-20 21:00:00',
            'date_end' => '2018-12-20 23:00:00', 
            'price' => 10,
            'current' =>[
                'En cours',
                'passé',
                'futur'
            ]
        
        ],

        [ 
            'id' => 2,
            'name' => 'Au rdv des bons copains',
            'category' => 'Discuter pholosophie au bord du feu',
            'presentation' =>'De longues discussions au coin du feu',
            'content' => 'Lorem * 150',
            'localisation' => " Salle Hilton, 5900 Lille",
            'image' => '../../assets/images/poster/philosophie.jpg',
            'date_creation' => '2018-12-20 21:00:00',
            'date_start' => '2018-11-20 21:00:00',
            'date_end' => '2018-11-20 23:00:00', 
            'price' => 100,
            'current' =>[
                'En cours',
                'passé',
                'futur'
            ]
        ]
    ]; */


    public function getAll(){

        $repo = $this->em->getRepository(Event::class);
        return $repo->findAll();
    }


/*     public function getOne($id){
        
        foreach ($this->events as $key => $event) {
            
            if ($event['id'] == $id){
                return $event;
            } 
                
        }
        return null;
    } */

    public function getOne ($id) {

        $repo = $this->em->getRepository(Event::class);
        return $repo->find($id);
    }


    public function getByName(EventRepository $eventRepo) :array
    {
        $events = $this->em->getRepository(Event::class)
        ->createQueryBuilder('m')
        ->orderBy('m.name', 'ASC');

        return $events->getQuery()->getResult();
    }



    public function countBydate($date) :string
    {
         $events = $this->em->getRepository(Event::class)
         ->createQueryBuilder('m')
         ->andWhere('m.startAt > :date')
         ->setParameter(':date', $date)
         ->select('count(m)');

         return $events->getQuery()->getSingleScalarResult();
    }



}

