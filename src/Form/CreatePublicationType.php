<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\Game;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreatePublicationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class,[
                'label' => false,
            ])
            ->add('description', TextareaType::class,[
                'label' => false,
            ])
            ->add('game', EntityType::class, array(
                'class' => Game::class,
                'choice_label' => 'title',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
