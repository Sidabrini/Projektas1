<?php
// src/Controller/SubscribtionController.php
namespace App\Controller;

use App\Entity\Subscribtion;
use App\Entity\Category;
use App\Entity\User;
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
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('subscribtion/index.html.twig');
    }

    /**
     * @Route("/admin/new", name="subscribtion_new", methods={"GET","POST"})
     */
    public function new(Request $request, SubscribtionRepository $subscribtionRepository, CategoryRepository $categoryRepository): Response
    {
        $category = new Category();
        $subscribtion = new Subscribtion();

        foreach ($categoryRepository->findAll() as $temp) {
            $form = $this->createFormBuilder($category)
                ->add('category', CheckboxType::class, [
                    'label' => $temp->getName(),
                    'required' => false,

                ])
                ->getForm();
        }

        $form->handleRequest($request);

        return $this->render('subscribtion/new.html.twig', [
            'form' => $form->createView(),
        ]);
        /*
        foreach ($categoryRepository->findAll() as $temp) {
            $form = $this->createFormBuilder($subscribtion)
                ->add('category', CheckboxType::class, [
                    'label' => $temp->getName(),
                    'required' => false,
                ])
                ->getForm();
        }
        if ($form->isSubmitted() && $form->isValid()) {
            $subscribtion->setUserid($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subscribtion);
            $entityManager->flush();

            return $this->redirectToRoute('event_index');
        }*/


    }
    //public function index(): Response
    //{
    //  return $this->render('event/subscriber.html.twig');
    //}
}