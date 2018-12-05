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
 
    // /**
    //  * @Route("/events/create", name="events_create")
    //  */
    // public function create(EventService $eventService, Request $request)
    // {
    //     $event = new Event();
    //     $formType = $this->createForm(FormType::class, $event);
    //     $formType->handleRequest($request);

    //     if ($formType->isSubmitted() && $formType->isValid()) {   

    //         $em = $this->getDoctrine()->getManager();
    //         $em->persist($event);
    //         $em->flush(); 

    //         // Message flash qui apparait sur la page d'accueil
    //         $this->addFlash(
    //             'notice',
    //             'Votre évenement ' .$event->getName() .' a été ajouté avec succès!'
    //         );

    //         // redirection vers la page d'accueil
    //         return $this->redirectToRoute('events_list');

    //     }

    //      return $this->render('events/create.html.twig', [
    //         'formType' => $formType->createView(),
    //     ]); 
    // }



    /**
     * @Route("/events/create", name="events_create")
     */
     public function create(EventService $eventService, Request $request)
     {
         $event = new Event();
         $formType = $this->createForm(FormType::class, $event);
         $formType->handleRequest($request);
 
         if ($formType->isSubmitted() && $formType->isValid()) {    
             $eventService->add($event);
         }
 
          return $this->render('events/create.html.twig', [
             'formType' => $formType->createView(),
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
                'events' => $eventService->search($querySearch, $querySort, $page),
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