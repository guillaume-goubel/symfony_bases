<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\EventService; 

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\RedirectResponse;

use App\Repository\EventRepository;

class EventsController extends AbstractController
{
    
    private $events;
    

    /**
     * @Route("/events/create", name="events_create")
     */
    public function create()
    {
        /* return $this->redirect('https://www.lemonde.fr'); */
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
        // $userChoise = $querySearch;
        $querySort = $request->query->get('sort');

        /* var_dump($querySearch); */

            return $this->render('events/list.html.twig', [
                'events' => $eventService->search($querySearch,$querySort),
                /* 'events' => $eventService->getAll(),  */
                'futur_events' => $eventService->countBydate(),
                'date' => $date, 
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

}