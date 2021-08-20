<?php

namespace App\Controller;

use App\Repository\MicroPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @Route("/", name="home")
     * @param MicroPostRepository $microPostRepository
     * @return Response
     */
    public function index(MicroPostRepository $microPostRepository): Response
    {
//        $user = $this->getUser();
//        $roles = ["ROLE_ADMIN"];
//        $user->setRoles($roles);
//        $this->em->flush();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'micro_posts' => $microPostRepository->findAll(),

        ]);
    }
}
