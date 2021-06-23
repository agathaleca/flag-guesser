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

        for ($i = 1; $i <=10 ; $i++)
        {
            $index = rand(0,count($flags));
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
