<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\EventRepository;

use App\Entity\Event;
use App\Entity\User;

class EventService {

    private $om;

    public function __construct(ObjectManager $om, EventRepository $repo ){
        $this->om = $om;
    }

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

    public function getOneUser ($id) {
        $repo = $this->om->getRepository(User::class); 
        return $repo->find($id);
    }

    public function search($name, $sort, $page) {
        $repo = $this->om->getRepository(Event::class); 
        return $repo->search($name, $sort, $page);
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

    public function add($event) {
    
        // Gestion des owner effectuée dans le service (l'Id sera toujours 1 en base)
        $repo = $this->om->getRepository(User::class); 
        $user = $repo->find(1);
        
        $event->setOwner($user);

        $this->setupMedia( $event );

        // Faire persister et flusher
        $this->om->persist($event);
        $this->om->flush();

        //Les étapes dans le controller en dessous :
        //  $em = $this->getDoctrine()->getManager();
        //  $em->persist($event);
        //$em->flush(); 
    }

    private function setupMedia($event){
        
        if( !empty( $event->getPosterUrl() ) ){
            return $event->setPoster( $event->getPosterUrl() );
        }

        $file = $event->getPosterFile();
        $filename = md5( uniqid() ) . '.' . $file->guessExtension();
        $file->move( './assets/images/poster/', $filename );
        
        return $event->setPoster( $filename );

    }

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
