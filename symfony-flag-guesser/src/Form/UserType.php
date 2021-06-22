<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('pseudo',TextType::class, [
            "attr" => [
                "class" => "form-control"
            ],
            "required" => true
        ])
        ->add('mail',EmailType::class,[
            "attr" => [
                "class" => "form-control"
            ],
            "required" => true
        ])
        -> add('password',PasswordType::class)
        -> add('password',RepeatedType::class, array( 
            'type' => PasswordType::class,
            'invalid_message' => 'The password fields must match.', 
            'options' => array('attr' => array('class' => 'password-field')), 
            'required' => true, 
            'first_options'  => array('label' => 'Password :'), 
            'second_options' => array('label' => 'Repeat Password :')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
