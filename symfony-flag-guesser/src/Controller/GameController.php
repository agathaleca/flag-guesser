<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/game/{id_game}", name="game")
     */
    public function index(GameRepository $gameRepository, int $id_game): Response
    {

        $quiz =  $gameRepository->findGameById($id_game);

        if ($quiz==null) {
            return $this->render('game/error.html.twig');
        }

        return $this->render('game/index.html.twig', [
            'controller_name' => 'GameController',
        ]);
    }
}
