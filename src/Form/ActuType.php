<?php

namespace App\Form;

use App\Entity\Actu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, array(
                'label'    => 'Titre de l\'actualité',
                'attr'     => array('class' => 'inputspecial'),
                'required' => false
            ))
            ->add('description', TextareaType::class, array(
                'label'    => 'Description'
            ))
            ->add('actuImage', FileType::class, array(
                'label'    => false,
                'mapped'   => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2000k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Veuillez insérer une image de type jpeg ou png'
                    ])
                ],
            ));
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Actu::class,
        ]);
    }
}
