<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UsersType;
use DateTimeInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    /**
     * @Route("/users/new",name="users_new")
     */
    // méthode d'ajout 
    // avec une reqête en entrée et une réponse en sortie
    public function new(Request $request) : Response {
        $users = new Users();
        $form = $this->createForm(UsersType::class,$users);
        $users->setCreatedOn(new \DateTime());

        // traitement du formulaire
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($users);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('users/new.html.twig', [
            "form" => $form->createView()
        ]);
    }

}
