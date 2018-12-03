<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\EventRepository;

use App\Entity\Event;


class EventService {

    private $om;
    private $repo; 

    public function __construct(ObjectManager $om, EventRepository $repo ){

        $this->om = $om;
        $this->repo = $repo;

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
        $repo = $this->om->getRepository(Event::class);
        return $this->repo->findAll();
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
        $repo = $this->om->getRepository(Event::class); 
        return $repo->find($id);
    }


    public function search($name, $sort) 
    {
        $repo = $this->om->getRepository(Event::class); 
        return $repo->search($name, $sort);
    }


    public function countBydate() {
         $repo = $this->om->getRepository(Event::class); 
         return $repo->countBydate();
    }


    public function sortByPrice() {
        $repo = $this->om->getRepository(Event::class); 
        return $repo->sortByPrice();
   }


   public function sortByDate() {
    $repo = $this->om->getRepository(Event::class); 
    return $repo->sortByDate();
}


}

