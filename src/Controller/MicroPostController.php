<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Entity\User;
use App\Form\MicroPostType;
use App\Repository\MicroPostRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/posts")
 */
class MicroPostController extends AbstractController
{
    private $session;
    private $em;

    public function __construct(SessionInterface $session, EntityManagerInterface $entityManager)
    {
        $this->session = $session;
        $this->em = $entityManager;

    }

    /**
     * @Route("/", name="micro_post_index", methods={"GET"})
     * @param MicroPostRepository $microPostRepository
     * @return Response
     */
    public function index(MicroPostRepository $microPostRepository): Response
    {
        return $this->render('micro_post/index.html.twig', [
            'micro_posts' => $microPostRepository->findAll(),
        ]);
    }

    /**
     * @Route("/you", name="micro_post_you", methods={"GET"})
     * @param MicroPostRepository $microPostRepository
     * @param UserRepository $userRepository
     * @return Response
     */
    public function userPosts(MicroPostRepository $microPostRepository, UserRepository $userRepository): Response
    {
        $user = $this->getUser();
        $posts = $microPostRepository->findBy(['user' => $user]);
        return $this->render('micro_post/you.html.twig', [
            'micro_posts' => $posts,
        ]);
    }


    /**
     * @Route("/new", name="micro_post_new", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function new(Request $request): Response
    {
        $microPost = new MicroPost();
        $form = $this->createForm(MicroPostType::class, $microPost);
        $microPost->setDate(new \DateTime('now'));
//        $microPost->setUpdatedAt(new \DateTime('now'));
        $user = $this->getUser();
        $microPost->setUser($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($microPost);
            $entityManager->flush();

            return $this->redirectToRoute('micro_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('micro_post/new.html.twig', [
            'micro_post' => $microPost,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="micro_post_show", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function show(MicroPost $microPost): Response
    {
        return $this->render('micro_post/show.html.twig', [
            'micro_post' => $microPost,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="micro_post_edit", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function edit(Request $request, MicroPost $microPost): Response
    {
        $form = $this->createForm(MicroPostType::class, $microPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('micro_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('micro_post/edit.html.twig', [
            'micro_post' => $microPost,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="micro_post_delete", methods={"POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function delete(Request $request, MicroPost $microPost): Response
    {
        if ($this->isCsrfTokenValid('delete' . $microPost->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($microPost);
            $entityManager->flush();
        }

        return $this->redirectToRoute('micro_post_index', [], Response::HTTP_SEE_OTHER);
    }
}
