<?php

namespace App\Form;

use App\Entity\Work;
use App\Form\LogoSizeType;
use Doctrine\ORM\Mapping\InheritanceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {   
        /* ($builder->create('logoSize', LogoSizeType::class, ['by_reference' => false])
           ('logoSize', CollectionType::class, [
                'entry_type' => IntegerType::class, 
                    'label' => 'Logo size : Enter width and height bellow',
                    'attr' => [
                        'style' => 'margin-left: 30px',
                    ],])     
            )*/
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'placeholder' => 'Titre du projet',
                ],
            ])
            ->add('projectTitle', TextType::class, [
                'attr' => [
                    'placeholder' => 'Intitulé du projet',
                ],
            ])
            ->add('logo', TextType::class, [
                'attr' => [
                    'placeholder' => 'Localisation de votre logo',
                ],
            ])
            ->add('Width', IntegerType:: class, [
                'label' => 'Logo - Largeur (En px)',
                'property_path'=>'logoSize[0]',
                'attr' => [
                    'style' => 'margin-left: 30px',
                ],
            ])
            ->add('Height', IntegerType:: class, [
                'label' => 'Logo - Hauteur (En px)',
                'property_path'=>'logoSize[1]',
                'attr' => [
                    'style' => 'margin-left: 30px',
                ],
            ])
            ->add('background', TextType::class, [
                'attr' => [
                    'placeholder' => 'Localisation de votre image de fond',
                ],
            ])
            ->add('tags', TextType::class, [
                'attr' => [
                    'placeholder' => 'Les tags de votre projet',
                ],
            ])
            ->add('desktop', CollectionType::class, [
                'entry_type' => ArrayTwoType::class,
                'label' => 'Desktop images  :',
                'required' => false,
                'attr' => [
                    'style' => 'margin-left: 30px',
                ],
                'allow_add' => true,
                'allow_delete' => true
            ])
            ->add('mobile', CollectionType::class, [
                'entry_type' => ArrayTwoType::class,
                'label' => 'Mobile images :',
                'required' => false,
                'attr' => [
                    'style' => 'margin-left: 30px',
                ],
                'allow_add' => true,
                'allow_delete' => true
            ])
            
            ->add('keywords', TextType::class, [
                'label' => "Mots clefs, ajouter les mots séparés par une virgule et un espace",
                'required' => false,
                'attr' => [
                    'placeholder' => 'Vos mots clefs',
                ],
            ])
            
            ->add('description', TextType::class , [
                'attr' => [
                    'placeholder' => 'Décrivez votre projet',
                ],
            ])
            ->add('skills', CollectionType::class, [
                'entry_type' => TextareaType::class,
                'label' => 'Compétences (Un paragraphe par champ)',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Votre compétence',
                ],
                'allow_add' => true,
                'allow_delete' => true
            ])
            ->add('comments', CollectionType::class, [
                'entry_type' => TextareaType::class,
                'label' => 'Commentaires ',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Votre commentaire',
                ],
                'allow_add' => true,
                'allow_delete' => true
            ])
            ->add('code')
            ->add('demo')
            ->add('Enregistrer', SubmitType::class);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Work::class,
        ]);
    }
}
