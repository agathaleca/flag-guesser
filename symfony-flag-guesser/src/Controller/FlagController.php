<?php

namespace App\Controller;

use App\Repository\FlagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FlagController extends AbstractController
{
    /**
     * @Route("/flag/{cont}", name="flag")
     */
    public function index(FlagRepository $flagRepository, string $cont): Response
    {
        return $this->render('flag/index.html.twig', [
            'controller_name' => 'FlagController',
            'flags' => $flagRepository->findAllFlagsInContinent($cont)
        ]);
    }
}
