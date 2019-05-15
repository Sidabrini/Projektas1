<?php
// src/Controller/SubscribtionController.php
namespace App\Controller;

use App\Entity\Subscribtion;
use App\Entity\Category;
use App\Entity\User;
use App\Repository\EventRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Form\UserType;
use App\Repository\CategoryRepository;
use App\Repository\SubscribtionRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

/**
 * @Route("/profile/subscribe")
 */
class SubscriptionController extends AbstractController
{
    /**
     * @Route("/", name="subscribtion_index", methods={"GET"})
     */
    public function index(SubscribtionRepository $subscribtionRepository, CategoryRepository $categoryRepository, EventRepository $eventRepository): Response
    {
        $index = 0;
        $subscribtions = $subscribtionRepository->findByUserId($this->getUser()->getId());

        foreach ($subscribtions as $sub) {
            $events[$index++] = $eventRepository->findByCategory($sub->getCategory());
        }

        if(isset($subscribtions[0])) {
            usort($events, function($a, $b) {
                return strcmp($a[0]->getCategory(), $b[0]->getCategory());
            });
            $categories = $categoryRepository->findById($subscribtions[0]->getCategory()->getId());
            return $this->render('subscribtion/index.html.twig', [
                'events' => $events,
            ]);
        }
        else{
            return $this->render('subscribtion/index.html.twig', [
                'events' => null,
            ]);
        }
    }

    /**
     * @Route("/admin/new", name="subscribtion_new", methods={"GET","POST"})
     */
    public function new(Request $request, SubscribtionRepository $subscribtionRepository, CategoryRepository $categoryRepository): Response
    {
        //nepavyko paanaudoti form nes kiekviena cikla persiraso elementas, o kito pavadinimo neuzdejau, nes pavadinimas susietas su kintamuoju
        $subscribtion = new Subscribtion();

        foreach ($categoryRepository->findAll() as $temp) {
            $form = $this->createFormBuilder($subscribtion)
                ->getForm();
        }

        if(!isset($request->request->all()["form"]))
            $form->handleRequest($request);

        if (isset($request->request->all()["form"])) {
            $em = $this->getDoctrine()->getManager();
            $subscribtions = $subscribtionRepository->findByUserId($this->getUser()->getId());
            foreach ($subscribtions as $subs) {
                $em->remove($subs);
            }
            $em->flush();
            $params = $request->request->all();
            foreach($params as $temp){
                if($temp != $params["form"]) {
                    $subscribtionnew = new Subscribtion();
                    $subscribtionnew->setCategory($categoryRepository->findById($temp)[0]);
                    $subscribtionnew->setUserid($this->getUser()->getId());
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($subscribtionnew);
                    $entityManager->flush();
                    $entityManager->clear();
                }
            }
            return $this->redirectToRoute('subscribtion_index');
        }
        //nerodo kokios katerogijos jau pasirinktos
        return $this->render('subscribtion/new.html.twig', [
            'categories' => $categoryRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }
}