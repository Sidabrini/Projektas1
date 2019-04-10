<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\Event1Type;
use App\Repository\EventRepository;
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
     * @Route("/", name="event_index", methods={"GET"})
     */
    public function index(EventRepository $eventRepository): Response
    {
        return $this->render('event/index.html.twig', [
            'events' => $eventRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/new", name="event_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $event = new Event();
        $form = $this->createFormBuilder($event)
            ->add('Title', TextType::class)
            ->add('Category', TextType::class)
            ->add('City', TextType::class)
            ->add('Address', TextType::class)
            ->add('Place', TextType::class)
            ->add('Date', DateType::class)
            ->add('Time', Type\TimeType::class)
            ->add('Duration', Type\TimeType::class)
            ->add('Price', Type\MoneyType::class)
            ->add('Description', Type\TextareaType::class)
            ->add('Creator', EntityType::class, [
                'class' => \App\Entity\User::class,
                'choice_label' => function(){return $this->getUser()->getEmail();},
                'disabled' => true
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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
        $form = $this->createFormBuilder($event)
            ->add('Title', TextType::class)
            ->add('Category', TextType::class)
            ->add('City', TextType::class)
            ->add('Address', TextType::class)
            ->add('Place', TextType::class)
            ->add('Date', DateType::class)
            ->add('Time', Type\TimeType::class)
            ->add('Duration', Type\TimeType::class)
            ->add('Price', Type\MoneyType::class)
            ->add('Description', Type\TextareaType::class)
            ->add('Creator', EntityType::class, [
                'class' => \App\Entity\User::class,
                'choice_label' => 'email',
                'disabled' => true
            ])
            ->getForm();
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
