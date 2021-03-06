<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Repository\GameRepository;
use App\Repository\FlagRepository;

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
    public function home(FlagRepository $flagRepository) {
        // le fichier twig qu'on veut afficher
        return $this->render('site/home.html.twig', [
            'flags' => $flagRepository->findCarouselFlags()
        ]);
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
    public function scores(GameRepository $gameRepository) {
        $classement_europe = $gameRepository->findBestCategory('Europe-');
        $classement_asie = $gameRepository->findBestCategory('Asie-');
        $classement_amerique = $gameRepository->findBestCategory('Amérique-');
        $classement_us = $gameRepository->findBestCategory('US States-');
        $classement_afrique = $gameRepository->findBestCategory('Afrique-');
        $classement_oceanie = $gameRepository->findBestCategory('Oceanie-');
        $classement_world = $gameRepository->findBestCategory('Amérique-Europe-Asie-US States-Afrique-Oceanie-');
        // le fichier twig qu'on veut afficher
        return $this->render('site/scores.html.twig', [
            "classement_europe" => $classement_europe,
            "classement_asie" => $classement_asie,
            "classement_world" => $classement_world,
            "classement_amerique" => $classement_amerique,
            "classement_us" => $classement_us,
            "classement_afrique" => $classement_afrique,
            "classement_oceanie" => $classement_oceanie
        ]);
    }

    /**
     * @Route("/connexion",name="connexion")
     */
    public function connexion() {
        // le fichier twig qu'on veut afficher
        return $this->render('site/connexion.html.twig');
    }

    /**
     * @Route("/inscription",name="inscription")
     */
    public function inscription() {
        return $this->render('site/inscription.html.twig');
    }
}
