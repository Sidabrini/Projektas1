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
    public function index(SubscribtionRepository $subscribtionRepository ): Response
    {
        return $this->render('subscribtion/index.html.twig', [
            'subscribtions' => $subscribtions = $subscribtionRepository->findByUserId($this->getUser()->getId())
        ]);
    }

    /**
     * @Route("/admin/new", name="subscribtion_new", methods={"GET","POST"})
     */
    public function new(Request $request, SubscribtionRepository $subscribtionRepository, CategoryRepository $categoryRepository): Response
    {
        $subscribtion = new Subscribtion();

        foreach ($categoryRepository->findAll() as $temp) {
            $form = $this->createFormBuilder($subscribtion)
                ->add('category', CheckboxType::class, [
                    'label' => $temp->getName(),
                    'required' => false,
                ])
                ->getForm();
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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
                    $subscribtionnew->setCategory($temp);
                    $subscribtionnew->setUserid($this->getUser()->getId());
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($subscribtionnew);
                    $entityManager->flush();
                    $entityManager->clear();
                }
            }
            return $this->redirectToRoute('subscribtion_index');
        }

        return $this->render('subscribtion/new.html.twig', [
            'cats' => $categoryRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }
    //public function index(): Response
    //{
    //  return $this->render('event/subscriber.html.twig');
    //}
}