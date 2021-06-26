<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\GameRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Contracts\Translation\TranslatorInterface;

class UserController extends AbstractController
{
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    /**
     * @Route("/users/new",name="users_new")
     */
    // méthode d'ajout 
    // avec une reqête en entrée et une réponse en sortie
    public function new(Request $request) : Response {
        $user = new User();
        $form = $this->createForm(UserType::class,$user);
        $user->setCreatedOn(new \DateTime());

        // traitement du formulaire
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            // debug
            // dd($form->getData());
            //encodage
            $user->setPassword (
                $this->passwordEncoder->encodePassword($user,$form->get("password")->getData())
            );

            $em = $this->getDoctrine()->getManager();

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('users/new.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/compte/{user_id}",name="compte")
     */
    public function compte(GameRepository $gameRepository, UserRepository $userRepository, int $user_id, Request $request, TranslatorInterface $translator) {
        $user = $userRepository->getUserById($user_id);
        
        $form = $this->createFormBuilder(null)
        ->add('locale', ChoiceType::class, [
            'choices' => [
                'Français' 		=> 'fr',
                'English(US)'	=> 'en'
            ]
        ])
        ->add('save', SubmitType::class)
        ->getForm()
        ;

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $locale = $form->getData()['locale'];
            $user = $this->getUser();
            $user->setLocale($locale);
            $em->persist($user);
            $em->flush();
        }

        
        // $historique = $translator->trans('compte.historique');
        return $this->render('users/compte.html.twig', [
            'user' => $user,
            'best_games' => $gameRepository->findBestUser($user),
            'form'		=> $form->createView(),
        ]);
    }

    /**
     * @Route("/changeLocale/{locale}",name="changeLocale")
     */
    public function changeLocale($locale, Request $request) {
        $request->getSession()->set('_locale', $locale);

        return $this->redirect($request->headers->get('referer'));
    }
}
