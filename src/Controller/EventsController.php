<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\EventService; 

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Repository\EventRepository;

class EventsController extends AbstractController
{
    
    private $events;
    

    /**
     * @Route("/events/create", name="events_create")
     */
    public function create()
    {
        return $this->render('events/create.html.twig', [
        ]);
    }


    /**
     * @Route("/events/list/", name="events_list")
     */
     public function list(EventService $eventService, Request $request)
     {
        $date = new \DateTime();

        $querySearch = $request->query->get('events');
        $userChoise = $querySearch;

        $querySort = $request->query->get('sort');

        /* var_dump($querySearch); */

        if ($querySort == 'OrderByprice-ASC'){
            
            return $this->render('events/list.html.twig', [
                'events' => $eventService->sortByPrice(), 
                /* 'events' => $eventService->getAll(),  */
                'futur_events' => $eventService->countBydate(),
                'date' => $date, 
            ]);

        } else if ($querySort == 'OrderByDate-ASC'){

            return $this->render('events/list.html.twig', [
                'events' => $eventService->sortByDate(), 
                /* 'events' => $eventService->getAll(),  */
                'futur_events' => $eventService->countBydate(),
                'date' => $date, 
            ]);
        }
        
        else {

            return $this->render('events/list.html.twig', [
            'events' => $eventService->getByName($userChoise), 
            /* 'events' => $eventService->getAll(),  */
            'futur_events' => $eventService->countBydate(),
            'date' => $date, 
        ]);

        }

     }


    /**
     * @Route("/events/display/{id}", name="events_display", requirements={"id"="\d+"})
     */
    public function display(EventService $eventService, $id)
    {
        return $this->render('events/display.html.twig', [
         
            'event' => $eventService->getOne($id)
        ]);
    }


    /**
     * @Route("/events/go/{id}", name="events_go", requirements={"id"="\d+"} )
     */
     public function go($id)
     {
         return $this->render('events/go.html.twig', [
                'id' => $id
         ]);
     }



    /**
     * @Route("/events/filtres/{name}", name="events_filtres" )
     */
    public function filtres(EventService $eventService)
    {

        $date = new \DateTime();
        
        return $this->render('events/filtres.html.twig' ,[

            'events' => $eventService->getByName(),
            'futur_events' => $eventService->countBydate(),

        ]); 

    }


     

}