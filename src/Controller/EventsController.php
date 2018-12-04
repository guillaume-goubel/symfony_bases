<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Event;

use App\Service\EventService; 

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\RedirectResponse;

use App\Repository\EventRepository;

use App\Form\FormType;
use Doctrine\Common\Persistence\ObjectManager;


class EventsController extends AbstractController
{
    
    private $events;

    
    /**
     * @Route("/events/create", name="events_create")
     */
    public function create()
    {

        $event= new Event();
        $formType = $this->createForm(FormType::class, $event);

        $request = Request::createFromGlobals();

        $formType->handleRequest($request);

        if ($formType->isSubmitted() && $formType->isValid()) {
            $data = $formType->getData();

            var_dump($data);
        }

         return $this->render('events/create.html.twig', [

            'formType' => $formType->createView(),
            'request' => $request

        ]); 
    }


    /**
     * @Route("/events/list", name="events_list" )
     */
     public function list(EventService $eventService, Request $request)
     {
        $date = new \DateTime();
        $page = 1;

        $querySearch = $request->query->get('events');
        $querySort = $request->query->get('sort');
        $page = $request->query->get('page');

        if(empty($page)){
            $page = 1; 
        }

            return $this->render('events/list.html.twig', [
                'events' => $eventService->search($querySearch,$querySort, $page),
                /* 'events' => $eventService->getAll(),  */
                'futur_events' => $eventService->countBydate(),
                'date' => $date, 
                'page' => $page,
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