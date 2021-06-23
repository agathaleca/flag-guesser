<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
        /**
     * @Route ("/question/{id_game}/{ans_player}",name="question")
     */

    public function checkQuestion(GameRepository $gameRepository,int $id_game, string $ans_player) : Response
    {
        // manager
        $em = $this->getDoctrine()->getManager();

        $quiz =  $gameRepository->findGameById($id_game);
        $current_question = $quiz->getCurrentQuestion();
        // si la réponse est la bonne 
        if ($current_question->getFlag()->getNomFr()==$ans_player) {
            // on stocke la réponse du joueur 
            $current_question->setPlayerAnswer($ans_player);
            $current_question->setTimeAnswered(new \Datetime());
            // on fixe le score de la question 
            $t = $current_question->getTimeAnswered()->diff($current_question->getTimeAsked())->s;
            if ($t<=4) {
                $current_question->setScore(100);
            }
            else {
                $points=-11/9*$t+15*11/9+1;
                $current_question->setScore($points*10);
            }
            // on change le statut de la question à "répondue"
            $current_question->setAsked(2);   
        }
        else {
            // mauvaise réponse + temps pas écoulé
            $current_question->setPlayerAnswer($ans_player);
            $current_question->setTimeAnswered(new \Datetime());
            // on fixe le score de la question 
            $t = $current_question->getTimeAnswered()->diff($current_question->getTimeAsked())->s;
            if ($t<15) {
                // maj de la bdd
                // on retourne la page avec la question actuelle (inchangée) pour retry
                $em->flush();
                return $this->redirectToRoute('game',[
                    'id_game'=>$quiz->getId()
                ]);
            }
            // mauvaise réponse + temps écoulé
            else {
                // stockage de la réponse du joueur
                $current_question->setPlayerAnswer($ans_player);
                $current_question->setTimeAnswered(new \Datetime());
                // on fixe le score de la question 
                $current_question->setScore(0);
                // on passe la question à "répondue"
                $current_question->setAsked(2);
            }
        }
        //maj bdd
        // à la fin :
        // mettre la prochaine question "non posée" à asked = 1 et time_asked à l'instant présent
        
        $questions_list = $quiz->getQuestions();
        foreach ($questions_list as $question) {
            if ($question->getAsked()==0) {
                // la première question à l'état "non posée" passe à "en cours"
                // on rempli ses champs en conséquence 
                $question->setTimeAsked(new \DateTime());
                $question->setAsked(1);
                // on s'arrête dés qu'une question "non posée" est trouvée
                break;
            }
        }

        $em->flush();
        // retourner la route de la page qui affiche la question avec la nouvelle current question
        return $this->redirectToRoute('game',[
            'id_game'=>$quiz->getId()
        ]);

    }
    /**
     * @Route("/game/{id_game}", name="game")
     */
    public function index(GameRepository $gameRepository, int $id_game): Response
    {

        $quiz =  $gameRepository->findGameById($id_game);

        if ($quiz==null) {
            return $this->render('game/noQuizError.html.twig');
        }

        $current_question = $quiz->getCurrentQuestion();

        if ($current_question==null) {
            return $this->render('game/recap.html.twig', [
                "question_list" => $quiz->getQuestions(),
                "game_score" => $quiz->getTotalScore(),
                "id_game" => $quiz->getId()
            ]);
        }

        return $this->render('game/index.html.twig', [
            'controller_name' => 'GameController',
            'id_game' => $id_game,
            'questions' => $quiz->getQuestions(),
            'current_question' => $current_question
        ]);
    }

}
