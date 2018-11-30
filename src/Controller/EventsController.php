<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\EventService; 
use Symfony\Component\HttpFoundation\Response;

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
     * @Route("/events/list", name="events_list")
     */
     public function list(EventService $eventService)
     {
        
         $this->events = $eventService->getAll();

         return $this->render('events/list.html.twig', [
             'events' => $this->events
         ]);

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

     

}