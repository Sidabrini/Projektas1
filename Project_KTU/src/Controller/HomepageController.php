<?php
    namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    class HomepageController extends  AbstractController{
        /**
         * @Route("/", name="homepage")
         */
        public function index() {
            return $this->render('base.html.twig');
        }
    }