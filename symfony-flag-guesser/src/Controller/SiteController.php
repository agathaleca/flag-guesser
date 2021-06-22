<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{
    /**
     * @Route("/site", name="site")
     */
    public function index(): Response
    {
        return $this->render('site/index.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }

    // ici on crée la page "racine" car la route est "/"
    /**
     * @Route("/",name="home")
     */
    public function home() {
        // le fichier twig qu'on veut afficher
        return $this->render('site/home.html.twig');
    }

    // ici on crée la page "quiz" car la route est "/quiz"
    /**
     * @Route("/quiz",name="quiz")
     */
    public function quiz() {
        // le fichier twig qu'on veut afficher
        return $this->render('site/quiz.html.twig');
    }

    /**
     * @Route("/scores",name="scores")
     */
    public function scores() {
        $repo = $this->getDoctrine()->getRepository(User::class);
        $users = $repo->findAll();
        // le fichier twig qu'on veut afficher
        return $this->render('site/scores.html.twig', [
            "users" => $users
        ]);
    }

    /**
     * @Route("/connexion",name="connexion")
     */
    public function connexion() {
        // le fichier twig qu'on veut afficher
        return $this->render('site/connexion.html.twig');
    }
}
