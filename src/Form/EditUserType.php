<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo', TextType::class,[
                'label' => false,
                // 'attr' => array(
                //     'placeholder' => 'PSEUDO'
                // )
            ])
            
            ->add('email', EmailType::class,[
                'label' => false,
                'attr' => array(
                    'placeholder' => 'EMAIL'
                )
            ])
            ->add('description', TextType::class, [
                
                'label' => false,
                'required' => false,
                'attr' => array(
                    
                    
                    
                )
            ])
            ->add('followers', NumberType::class, [
                'label' => false,
                'attr' => array(
                    'placeholder' => 'NOMBRE DE FOLLOWERS'
                )
            ])
            //->add('submit', SubmitType::class)
            // ->add('roles')
            // ->add('token')
            // ->add('avatar')
            // ->add('twitch_link')
            // ->add('modified_at')
            // ->add('created_at')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
