<?php

namespace App\Controller;

use App\Repository\FlagRepository;
use App\Entity\Question;
use App\Entity\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FlagController extends AbstractController
{
    /**
     * @Route("/flag/{cont}", name="flag")
     */
    public function start_game(FlagRepository $flagRepository, string $cont): Response
    {
        $flags = $flagRepository->findAllFlagsInContinent($cont);
        $em = $this->getDoctrine()->getManager();
        // quizz
        $quiz = new Game();
        $quiz->setCategory($cont);
        $quiz->setPlayedOn(new \DateTime());

        // liste temporaire des drapeaux dans le quiz
        $flags_in_quiz = array();

        for ($i = 1; $i <=10 ; $i++)
        {

            do {
                $index = rand(0,count($flags)-1);
            } while(in_array($flags[$index],$flags_in_quiz));
            
            // ajout à la liste temporaire (vérifier que pas deux drapeaux pareils)
            array_push($flags_in_quiz,$flags[$index]);
            
            $question = new Question();
            $question->setFlag($flags[$index]);
            $question->setAsked(0);
            $quiz->addQuestion($question);

            
            $em->persist($question);
        }
        $em->persist($quiz);

        $first_question = $quiz->getQuestions()[0];
        $first_question->setTimeAsked(new \DateTime());
        $first_question->setAsked(1);
        $em->flush();

        return $this->redirectToRoute('game',[
            'id_game'=>$quiz->getId()
        ]);
    }
}
