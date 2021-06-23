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
            return $this->render('game/errorNoQuizz.html.twig');
        }

        $current_question = $quiz->getCurrentQuestion();

        if ($current_question==null) {
            return $this->render('game/errorNoCurrent.html.twig');
        }

        return $this->render('game/index.html.twig', [
            'controller_name' => 'GameController',
            'questions' => $quiz->getQuestions(),
            'current_question' => $current_question
        ]);
    }

    /**
     * @Route ("/game/{id_game}/{id_question}",name="question")
     */

    
    public function checkQuestion(GameRepository $gameRepository,string $ans_player,int $id_game) : Response
    {
        $quiz =  $gameRepository->findGameById($id_game);
        $current_question = $quiz->getCurrentQuestion();
        // si la réponse est la bonne 
        if ($current_question->getFlag()->getNomFr()==$ans_player) {
            // on stocke la réponse du joueur 
            $current_question->setPlayerAnswer($ans_player);
            $current_question->updateTimeAnswered();
            // on fixe le score de la question 
            if ($current_question->getTimeAnswered()<=4) {
                $current_question->setScore($current_question->getScore()+10);
            }
            else {
                $points=-11/9*$current_question->getTimeAnswered()+15*11/9+1;
                $current_question->setScore($current_question->getScore()+$points);
            }
            // on change le statut de la question à "répondue"
            $current_question->setAsked(2);            
        }
        else {
            // mauvaise réponse + temps pas écoulé
            if ($current_question->getTimeAnswered()<15) {
                // on retourne la page avec la question actuelle (inchangée) pour retry
                return $this->render('game/index.html.twig',[
                    'controller_name' => 'GameController',
                    'current_question' => $current_question
                ]);
            }
            // mauvaise réponse + temps écoulé
            else {
                // stockage de la réponse du joueur
                $current_question->setPlayerAnswer($ans_player);
                // on entre quand même le temps mis pour répondre à la question (pas le laisser vide)
                $current_question->updateTimeAnswered();
                // on passe la question à "répondue"
                $current_question->setAsked(2);
            }
        }

        // à la fin :
        // mettre la question d'après à asked = 1
        $current_question = $quiz->getNextQuestion();
        // mettre sa time_asked à l'instant présent
        $current_question->setTimeAsked(new \DateTime());
        // retourner la route de la page qui affiche la question avec la nouvelle current question
        return $this->render('game/index.html.twig',[
            'controller_name' => 'GameController',
            'current_question' => $current_question
        ]);
    }
}
