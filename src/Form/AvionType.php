<?php

namespace App\Form;

use App\Entity\Avion;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Doctrine\Persistence\ManagerRegistry;





class AvionType extends AbstractType
{
    public function __construct(private ManagerRegistry $doctrine)
    {
        
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder               
            ->add('codigo', TextType::class, [
                    'attr' => ['placeholder' => 'Máximo 75 caracteres','class' => 'borderradius'],
                    'label_attr' => ['class' => 'text-primary'],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Por favor introduzca un codigo.',
                        ]),
                        new Length([
                            'maxMessage' => 'El codigo es demasiado largo. Maximo  {{ limit }} caracteres.',
                            // max length allowed by Symfony for security reasons
                            'max' => 75,
                        ]),
                    ],
                ])
            ->add('modelo', TextType::class,[
                'attr' => ['placeholder' => 'Máximo 75 caracteres','class' => 'borderradius'],
                'label_attr' => ['class' => 'text-primary'],
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor introduzca un modelo.',
                    ]),
                    new Length([
                        'maxMessage' => 'El nombre del modelo es demasiado largo. Maximo  {{ limit }} caracteres.',
                        // max length allowed by Symfony for security reasons
                        'max' => 75,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avion::class,
        ]);
    }
}