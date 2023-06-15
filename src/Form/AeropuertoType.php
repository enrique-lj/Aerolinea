<?php

namespace App\Form;

use App\Entity\Aeropuerto;
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





class AeropuertoType extends AbstractType
{
    public function __construct(private ManagerRegistry $doctrine)
    {
        
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder               
            ->add('nombre', TextType::class, [
                    'attr' => ['placeholder' => 'Máximo 75 caracteres','class' => 'borderradius'],
                    'label_attr' => ['class' => 'text-primary'],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Por favor introduzca un nombre.',
                        ]),
                        new Length([
                            'maxMessage' => 'El nombre es demasiado largo. Maximo  {{ limit }} caracteres.',
                            // max length allowed by Symfony for security reasons
                            'max' => 75,
                        ]),
                    ],
                ])
            ->add('localidad', TextType::class,[
                'attr' => ['placeholder' => 'Máximo 75 caracteres','class' => 'borderradius'],
                'label_attr' => ['class' => 'text-primary'],
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor introduzca una localidad.',
                    ]),
                    new Length([
                        'maxMessage' => 'El nombre de localidad es demasiado largo. Maximo  {{ limit }} caracteres.',
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
            'data_class' => Aeropuerto::class,
        ]);
    }
}