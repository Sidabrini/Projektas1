<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventFilterType;
use App\Form\EventType;
use App\Repository\EventRepository;
use App\Repository\SubscribtionRepository;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\FloatType;
use Doctrine\ORM\Mapping\Entity;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\User;

/**
 * @Route("/profile/event")
 */
class EventController extends AbstractController
{
    /**
     * @Route("/", name="event_index", methods={"GET", "Post"})
     */
    public function index(EventRepository $eventRepository, Request $request ): Response
    {
        $form = $this->createForm(EventFilterType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $filter = $request->request->get('event_filter');

            $event = $eventRepository->findByFilterData(
                $filter['Title'],
                $filter['Category'],
                $filter['Date'],
                $filter['Price_from'],
                $filter['Price_up_to']
                );
        }
        else{
            $event = $eventRepository->findAll();
        }

        return $this->render('event/index.html.twig', [
            'events' => $event,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/new", name="event_new", methods={"GET","POST"})
     */
    public function new(Request $request, \Swift_Mailer $mailer, UserRepository $userRepository, SubscribtionRepository $subscribtionRepository): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->get('Creator')->setData($this->getUser());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $subscribers = $subscribtionRepository->findByCategoryId($event->getCategory()->getId());
            foreach ($subscribers as $subscriber) {
                $user = $userRepository->findById($subscriber->getUserId());
                $message = (new \Swift_Message('DD projektas'))
                    ->setFrom("DD.project@noreply.com")
                    ->setTo($user[0]->getEmail())
                    ->setBody(
                        "Prie jūsų prenumeruotos kategorijos: " . $event->getCategory()->getName() . "",
                        'text/plain'
                    );
                $mailer->send($message);
            }
            $event->setCreator($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();
            return $this->redirectToRoute('event_index');
        }

        return $this->render('event/new.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_show", methods={"GET"})
     */
    public function show(Event $event): Response
    {
        return $this->render('event/show.html.twig', [
            'event' => $event,
        ]);
    }

    /**
     * @Route("/admin/{id}/edit", name="event_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Event $event): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('event_index', [
                'id' => $event->getId(),
            ]);
        }

        return $this->render('event/edit.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/{id}", name="event_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Event $event): Response
    {
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($event);
            $entityManager->flush();
        }

        return $this->redirectToRoute('event_index');
    }
}
